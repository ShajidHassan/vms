<?php

namespace App\Http\Controllers;

use App\Account;
use App\Helper;
use App\Purchases;
use App\Sold;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Category;
use App\Vehicle;
use App\VehiclesImage;
use Intervention\Image\Facades\Image;

class VehiclesController extends Controller
{
    // Vehicle Info DB te store
    public function booking($id = null)
    {
        if (intval($id) > 0) {
            $vehicleDetails = DB::table("vehicles")
                ->join("solds","solds.vechicle_id", "=", "vehicles.id")
                ->where('vehicles.deleted_at','=', null)
                ->where('solds.action','=', "on")
                ->where('solds.booking_status','=', null)
                ->selectRaw("vehicles.*,solds.sold_qty, solds.booking_rate,solds.sale_price,solds.show_room, solds.address, solds.phone AS contact, solds.booking_status")
                ->where('vehicles.id', "=", intval($id))
                ->first();

            if ($vehicleDetails !== null) {
                if ($vehicleDetails->booking_status == "booked")
                    return redirect()->back()->with(["message_error" => "Sorry, not available now. Already booked "]);

                $amountForBooking = ($vehicleDetails->sale_price * ($vehicleDetails->booking_rate / 100));

                $accounts = DB::table("accounts")
                    ->where("holder_ref", "=", Session::get("user_id"))
                    ->Where("holder_type", "=", "User")
                    ->where("deleted_at", "=", null)
                    ->pluck('acc_no', 'id')->toArray();
                return view('vehicles.booking')->with(compact('vehicleDetails', 'amountForBooking', 'accounts'));
            } else {
                return redirect()->back()->with(["message_error" => "vehicle not found"]);
            }
        } else {
            return redirect()->back()->with(["message_error" => "Invalid Params supplied"]);
        }
    }

    public function bookingConfirm(Request $request)
    {
        if ($request->isMethod('POST')) {
            $vid = intval($request->v_id);
            if ($vid < 0) {
                return redirect()->route("public.vechicle_details",['id' => $vid])->with(["message_error" => "Invalid Params supplied"]);
            }

            $bookingAmount = floatval($request->booking_amount);
            if ($bookingAmount < 0) {
                return redirect()->back()->with(["message_error" => "Invalid Amount supplied"]);
            }

            $vehicleDetails = DB::table("vehicles")
                ->join("solds","solds.vechicle_id", "=", "vehicles.id")
                ->where('vehicles.deleted_at','=', null)
                ->where('solds.action','=', "on")
                ->where('solds.booking_status','=', null)
                ->selectRaw("vehicles.admin_id,solds.sold_qty, solds.booking_rate, solds.sale_price,solds.diposit_account")
                ->where('vehicles.id', "=", intval($vid))
                ->first();

            if ($vehicleDetails === null) {
                return redirect()->route("public.vechicle_details",['url' => $vid])->with(["message_error" => "vehicle not found"]);
            }

            $vehiclePrice = $vehicleDetails->sale_price;
            $amountForBooking = round(($vehiclePrice * ($vehicleDetails->booking_rate / 100)));
            if ($bookingAmount >= $amountForBooking) {
                $bookerId = Session::get('user_id');

                $accountId = intval($request->account_key);
                if ($accountId < 0) {
                    return redirect()->back()->with(["message_error" => "Invalid account supplied"]);
                }

                $bookerAccount = Account::where(['id' => $accountId, 'holder_ref' => $bookerId, 'holder_type' => "User"])->first();

                if ($bookerAccount == null)
                    return redirect()->back()->with(["message_error" => "Account not available"]);


                if ($bookerAccount->amount > 0 && $bookerAccount->amount - $bookingAmount >= 0) {
                    $tax = $vehicleDetails->booking_rate;
                    $taxAmount = Helper::calculateTax($bookingAmount, $tax);
                    $netAmount = ($bookingAmount - $taxAmount);

                    $brandAccount = Account::where([
                        'holder_ref' => $vehicleDetails->admin_id,
                        'holder_type' => "Marchant",
                        'isDefault' => 1,
                        'acc_no' => $vehicleDetails->diposit_account
                    ])->first();

                    try {
                        $brandAccount->amount += $netAmount;
                        $brandAccount->save();

                        $bookerAccount->amount -= $bookingAmount;
                        $bookerAccount->save();

                        //Vehicle owner transaction
                        $brandTransaction = new Transaction();
                        $brandTransaction->trans_by = $bookerId;
                        $brandTransaction->vechicle_id = $vid;
                        $brandTransaction->trans_for = "merchant";
                        $brandTransaction->from_account = $bookerAccount->acc_no;
                        $brandTransaction->to_account = $brandAccount->acc_no;
                        $brandTransaction->amount = $bookingAmount;
                        $brandTransaction->tax = $tax;
                        $brandTransaction->tax_amount = $taxAmount;
                        $brandTransaction->net_amount = $netAmount;
                        $brandTransaction->trans_type = "deposit";
                        $brandTransaction->amount_type = "cash";
                        $brandTransaction->note = "Amount deposit from: " . $bookerAccount->acc_no . " To My account: " . $brandAccount->acc_no . " for Booking. Booking Amount:" . $bookingAmount . "Tk  Tax:" . $tax . "% TaxAmount:" . $taxAmount . "Tk  You paid amount: " . $netAmount . "Tk" . " Admin cut: " . $taxAmount . " Tk";
                        $brandTransaction->save();


                        //booker transaction
                        $bookerTransaction = new Transaction();
                        $bookerTransaction->vechicle_id = $vid;
                        $bookerTransaction->trans_by = $bookerId;
                        $bookerTransaction->trans_for = "user";
                        $bookerTransaction->from_account = $bookerAccount->acc_no;
                        $bookerTransaction->to_account = $brandAccount->acc_no;
                        $bookerTransaction->amount = $bookingAmount;
                        $bookerTransaction->tax = "0";
                        $bookerTransaction->tax_amount = "0";
                        $bookerTransaction->net_amount = $bookingAmount;
                        $bookerTransaction->trans_type = "withdraw";
                        $bookerTransaction->amount_type = "cash";
                        $bookerTransaction->note = "Amount withdraw from My account: " . $bookerAccount->acc_no . " Transfer To Brand account: " . $brandAccount->acc_no . " for Booking amount: " . $bookingAmount . "Tk";
                        $bookerTransaction->save();


                        //site owner transaction
                        $siteAccount = Account::where(['holder_ref' => 2, 'holder_type' => 'Super Admin', 'isDefault' => 1])->first();
                        $siteAccount->amount += $taxAmount;
                        $siteAccount->save();

                        $siteOwnerTransaction = new Transaction();
                        $siteOwnerTransaction->vechicle_id = $vid;
                        $siteOwnerTransaction->trans_by = $bookerId;
                        $siteOwnerTransaction->trans_for = "super-admin";
                        $siteOwnerTransaction->from_account = $brandAccount->acc_no;
                        $siteOwnerTransaction->to_account = $siteAccount->acc_no;
                        $siteOwnerTransaction->amount = 0;
                        $siteOwnerTransaction->tax = "0";
                        $siteOwnerTransaction->tax_amount = "0";
                        $siteOwnerTransaction->net_amount = $taxAmount;
                        $siteOwnerTransaction->trans_type = "tax";
                        $siteOwnerTransaction->amount_type = "cash";
                        $siteOwnerTransaction->note = "Amount deposit from: " . $bookerAccount->acc_no . " To My account: " . $siteAccount->acc_no . " for Booking amount: " . $bookingAmount . "Tk Tax:" . $tax . "% TaxAmount:" . $taxAmount . "Tk Your paid amount: " . $taxAmount . "Tk";
                        $siteOwnerTransaction->save();

                        DB::table("solds")
                            ->where("vechicle_id","=",intval($vid))
                            ->where("marchant_id" ,"=", $vehicleDetails->admin_id)
                            ->where("action","=","on")
                            ->update(["booking_status" => "booked"]);

                        return redirect()->route("home.index")->with(["message" => "Booking placed success"]);

                    }catch (\Exception $exception){
                        dd($exception->getTrace());
                        return redirect()->back()->with(["message_error" => "Booking placed failed"]);
                    }
                } else {
                    return redirect()->back()->with(["message_error" => "Not sufficient amount for booking"]);
                }
            } else {
                return redirect()->back()->with(["message_error" => "You must be required " . $vehicleDetails->booking_rate . " % of price"]);
            }

        }
    }

    public function checkPermission(){
        $permissionId = intval(Session::get('marchant_id'));
        if($permissionId <= 0){
            return redirect()->back()->with('message_error','You must be login first');
        }

        $marChantExists = DB::table("admins")
            ->where("deleted_at","=", null)
            ->where("id", "=",$permissionId)->first();

        if($marChantExists === null){
            return redirect()->back()->with('message_error','You must be signup first');
        }
    }

    public function addVehicle(Request $request, $id = null)
    {
        $this->checkPermission();
        //dd($request->all());
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (empty($data['category_id'])) {
                return redirect()->back()->with('message_error', 'Under Category is Missing');
            }

            $marchantId = intval(Session::get('marchant_id'));
            if($marchantId <= 0)
                return redirect()->back()->with('message_error', 'You must be need login');

            $vehicle = new Vehicle;
            $vehicle->category_id = $data['category_id'];
            $vehicle->admin_id = $marchantId;
            $vehicle->brand = $data['brand'];
            $vehicle->model = $data['model'];
            $vehicle->year = $data['year'];
            $vehicle->mileage = $data['mileage'];
            $vehicle->engine_capacity = $data['engine_capacity'];
            $vehicle->fuel_type = $data['fuel_type'];
            $vehicle->max_power = $data['max_power'];
            $vehicle->max_speed = $data['max_speed'];
            $vehicle->torque = $data['torque'];
            $vehicle->fuel_consumption = $data['fuel_consumption'];
            $vehicle->door = $data['door'];
            $vehicle->drive_type = $data['drive_type'];
            $vehicle->seats = $data['seats'];
            $vehicle->wheel_base = $data['wheel_base'];
            $vehicle->weight = $data['weight'];
            $vehicle->length = $data['length'];
            $vehicle->width = $data['width'];
            $vehicle->height = $data['height'];
            $vehicle->fuel_tank_capacity = $data['fuel_tank_capacity'];
            $vehicle->color = $data['color'];
            $vehicle->no_of_cylinder = $data['no_of_cylinder'];
            $vehicle->description = $data['description'];

            //$vehicle->sale_price = $data['sale_price'];
            //$vehicle->selling = $data['selling'];
            // Image Upload
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/backend_images/vehicles/large/' . $filename;
                    $medium_image_path = 'images/backend_images/vehicles/medium/' . $filename;
                    $small_image_path = 'images/backend_images/vehicles/small/' . $filename;
                    //Resize Images
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300, 300)->save($small_image_path);

                    //Store image in vehicles table
                    $vehicle->image = $filename;
                }
            }

            try {

                $vehicle->save();
                $purchases = new Purchases;
                $purchases->vechicle_id = $vehicle->id;
                $purchases->owner_id = $marchantId;
                $purchases->qty = $data['qty'];
                $purchases->cost_price = $data['cost_price'];
                $purchases->total_amount = round((intval($data['qty']) * round(doubleval($data['cost_price']), 2)), 2);
                $purchases->tax = !empty($data['tax']) ? round(doubleval($data['tax']),2) : 0.00;
                $purchases->show_room_name = $data['showroom_name'];
                $purchases->address = $data['address'];
                $purchases->phone = $data['contact'];
                $purchases->save();

            }catch (\Exception $exception){
                return redirect()->back()->with('message_error', 'Purchases failed due to incorrect data');
            }

            return redirect()->back()->with('message', 'Vehicle has been added Successfully');
        }else{
            $categories = Category::where(['parent_id' => 0])->get();
            $categories_dropdown = "<option selected disabled>Select</option>";
            foreach ($categories as $cat) {
                $categories_dropdown .= "<optgroup label='" . $cat->name . "'>";
                $sub_categories = Category::where(['parent_id' => $cat->id])->get();
                foreach ($sub_categories as $sub_cat) {
                    $categories_dropdown .= "<option value='" . $sub_cat->id . "'>" . $sub_cat->name . "</option>";
                }
                $categories_dropdown .= "</optgroup>";
            }
            return view('marchant.add-vehicle')->with(compact('categories_dropdown'));
        }
    }

    public function viewVehicles()
    {
        $this->checkPermission();
        $vehicles = DB::table('vehicles')
            ->join('admins', 'vehicles.admin_id', '=', 'admins.id')
            ->join("purchases","purchases.vechicle_id", "=", "vehicles.id")
            ->where('admin_id', '=', Session::get('marchant_id'))
            ->where('vehicles.deleted_at', '=', null)
            ->selectRaw("vehicles.*, purchases.qty, purchases.cost_price, purchases.show_room_name, purchases.address, purchases.phone AS contact")
            ->get();
        foreach ($vehicles as $key => $val) {
            $category_name = Category::where(['id' => $val->category_id])->first();
            $vehicles[$key]->category_name = $category_name->name;
        }
        return view('marchant.view-vehicles')->with(compact('vehicles'));
    }


    public function detailsVehicles($id)
    {
        $this->checkPermission();
        if(intval($id) > 0){
            $vehicle = Vehicle::with("purchasses","category")->where("id","=", intval($id))->first();
            return view('marchant.details-vehicles')->with(compact('vehicle'));
        }else{
            return redirect()->back()->with("message_error", "Invalid parameter supplied");
        }

    }

    public function salesVehicles($id)
    {
        $this->checkPermission();
        if(intval($id) > 0){
            $vehicle = Vehicle::with("category","sales")
                ->where("id","=", intval($id))
                ->where("deleted_at", "=", null)
                ->first();
            return view('marchant.solds-vehicles')->with(compact('vehicle'));
        }else{
            return redirect()->back()->with("message_error", "Invalid parameter supplied");
        }

    }

    public function soldVehicles($id = null)
    {
        $this->checkPermission();
        if(intval($id) > 0){
            $vehicle = Vehicle::with("category")->where("id","=", intval($id))->first();
            if($vehicle != null) {
                $lastPurchases = DB::table("purchases")
                    ->where("vechicle_id","=",$vehicle->id)
                    ->orderBy("created_at","DESC")
                    ->first();
                $accounts = DB::table("accounts")
                    ->where("holder_ref", "=", Session::get("marchant_id"))
                    ->Where("holder_type", "=", "Marchant")
                    ->where("deleted_at", "=", null)
                    ->pluck('acc_no', 'id')->toArray();
                return view('marchant.sold-vehicles')->with(compact('vehicle', 'accounts','lastPurchases'));
            }else{
                return redirect()->back()->with("message_error", "Missing Vechicle Information");
            }
        }else{
            return redirect()->back()->with("message_error", "Invalid parameter supplied");
        }

    }

    public function soldPostVehicles(Request $request)
    {
        //dd($request->all());
        $this->checkPermission();
        if($request->isMethod("POST")){

            $v_id = intval($request->input('v_id'));
            if($v_id <= 0)
                return redirect()->back()->with("message_error", "Invalid Information");

            $vehicle = Vehicle::where("id","=", intval($v_id))->first();
            if($vehicle != null) {
                $accountKey = intval($request->input("account_key"));
                if($accountKey <= 0)
                    return redirect()->back()->with("message_error", "Invalid Account Information");

                $account = DB::table("accounts")
                    ->where("holder_ref", "=", intval(Session::get("marchant_id")))
                    ->Where("holder_type", "=", "Marchant")
                    ->where("deleted_at", "=", null)
                    ->where('id', '=', $accountKey)->first();

                if($account == null)
                    return redirect()->back()->with("message_error", "Account Missing");

                    $sold = new Sold();
                    $sold->vechicle_id = $vehicle->id;
                    $sold->marchant_id = intval(Session::get("marchant_id"));
                    $sold->diposit_account = $account->acc_no;
                    $sold->sold_qty = intval($request->input("qty"));
                    $sold->sale_price = intval($request->input("sale_price"));
                    $sold->booking_rate = intval($request->input("rate"));
                    $sold->show_room = $request->input("showroom_name");
                    $sold->address = $request->input("address");
                    $sold->phone = $request->input("contact");

                    try{
                        $sold->save();
                    }catch (\Exception $exception){
                        return redirect()->back()->with("message_error", "Vechicle Place failed");
                    }

                return redirect()->back()->with("message", "Vechicle Place success for sold");
            }else{
                return redirect()->back()->with("message_error", "Missing Vechicle Information");
            }
        }else{
            return redirect()->back()->with("message_error", "Invalid parameter supplied");
        }

    }

    public function editVehicle($id = null)
    {
        $this->checkPermission();
        if(intval($id) > 0) {
            $vechicle = Vehicle::where(['id' => $id])->first();
            //Categories Drop Down Start
            $categories = Category::where(['parent_id' => 0])->get();
            $categories_dropdown = "<option selected disabled>Select</option>";
            foreach ($categories as $cat) {
                if ($cat->id == $vechicle->category_id) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $categories_dropdown .= "<optgroup label='" . $cat->name . "' " . $selected . ">";
                $sub_categories = Category::where(['parent_id' => $cat->id])->get();
                foreach ($sub_categories as $sub_cat) {
                    if ($sub_cat->id == $vechicle->category_id) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $categories_dropdown .= "<option value='" . $sub_cat->id . "' " . $selected . ">" . $sub_cat->name . "</option>";
                }
                $categories_dropdown .= "</optgroup>";
            }
            //Categories Drop Down Ends
            return view('marchant.edit-vehicle')->with(compact('vechicle', 'categories_dropdown'));
        }else{
            return redirect()->back()->with("message_error","Invalid request");
        }

    }

    public function updateVehicle(Request $request)
    {
        $this->checkPermission();
        if ($request->isMethod('POST')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data);die;
            // Image Upload
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/backend_images/vehicles/large/' . $filename;
                    $medium_image_path = 'images/backend_images/vehicles/medium/' . $filename;
                    $small_image_path = 'images/backend_images/vehicles/small/' . $filename;
                    //Resize Images
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300, 300)->save($small_image_path);
                }
            } else {
                $filename = $data['current_image'];
            }

            // DB info UPDATE QUERY

            $id = intval($request->input("id"));
            if($id <= 0)
                return redirect()->back()->with("message_error","Invalid request");

            Vehicle::where(['id' => $id])
                ->update(
                    [
                        'category_id' => $data['category_id'],
                        'brand' => $data['brand'],
                        'model' => $data['model'],
                        'year' => $data['year'],
                        'mileage' => $data['mileage'],
                        'engine_capacity' => $data['engine_capacity'],
                        'fuel_type' => $data['fuel_type'],
                        'max_power' => $data['max_power'],
                        'max_speed' => $data['max_speed'],
                        'torque' => $data['torque'],
                        'door' => $data['door'],
                        'fuel_consumption' => $data['fuel_consumption'],
                        'drive_type' => $data['drive_type'],
                        'seats' => $data['seats'],
                        'wheel_base' => $data['wheel_base'],
                        'weight' => $data['weight'],
                        'length' => $data['length'],
                        'width' => $data['width'],
                        'height' => $data['height'],
                        'fuel_tank_capacity' => $data['fuel_tank_capacity'],
                        'color' => $data['color'],
                        'no_of_cylinder' => $data['no_of_cylinder'],
                        'description' => $data['description'],
                        'image' => $filename]);

            return redirect()->back()->with('message', 'Vehicle has been Edited Succesfully');
        }else {
            return redirect()->back()->with("message_error","Invalid request");
        }
    }

    public function deleteVehicle(Request $request)
    {
        $this->checkPermission();
        $id = intval($request->v_id);
        if (intval($id) > 0) {
            //Get Vehicle Image
//            $vehicleImage = Vehicle::where(['id' => $id])->first();
//            //Get Vehicle Image Paths
//            $large_image_path = 'images/backend_images/vehicles/large/';
//            $medium_image_path = 'images/backend_images/vehicles/medium/';
//            $small_image_path = 'images/backend_images/vehicles/small/';
//
//            //Delete Large Image
//            if (file_exists($large_image_path . $vehicleImage->image)) {
//                unlink($large_image_path . $vehicleImage->image);
//            }
//
//            //Delete medium Image
//            if (file_exists($medium_image_path . $vehicleImage->image)) {
//                unlink($medium_image_path . $vehicleImage->image);
//            }
//
//
//            //Delete small Image
//            if (file_exists($small_image_path . $vehicleImage->image)) {
//                unlink($small_image_path . $vehicleImage->image);
//            }
            $vechicle = Vehicle::where("id", $id)->first();
            if($vechicle == null)
                return redirect()->back()->with("message_error", "Vechicle not found");

            $vechicle->deleted_at = Carbon::now();
            $vechicle->save();

            return redirect()->back()->with('message', 'Vehicle deleted Successfully');
        }
    }

    // Add admin Alternate images
    public function addImages(Request $request, $id = null)
    {
        $this->checkPermission();
        // echo "test"; die;
        $vehicleDetails = Vehicle::where(['id' => $id])->first();

        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if ($request->hasFile('image')) {
                $files = $request->file('image');
                foreach ($files as $file) {
                    $image = new VehiclesImage;
                    $extension = $file->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/backend_images/vehicles/large/' . $filename;
                    $medium_image_path = 'images/backend_images/vehicles/medium/' . $filename;
                    $small_image_path = 'images/backend_images/vehicles/small/' . $filename;
                    //Resize Images
                    Image::make($file)->save($large_image_path);
                    Image::make($file)->resize(600, 600)->save($medium_image_path);
                    Image::make($file)->resize(300, 300)->save($small_image_path);

                    //Store image in vehicles table
                    $image->image = $filename;
                    $image->vehicle_id = $data['vehicle_id'];
                    $image->save();

                }

            }

            return redirect('/backend/add-images/' . $id)->with('flash_message_success', 'Vehicle Images has been added Succesfully');
        }
        $vehiclesImages = VehiclesImage::where(['vehicle_id' => $id])->get();
        // $vehiclesImages = json_decode(json_encode($vehiclesImages));
        return view('marchant.add-images')->with(compact('vehicleDetails', 'vehiclesImages'));
    }

    //  Delete admin Alternare image
    public function deleteAltImage(Request $request, $id = null)
    {
        $this->checkPermission();
        //Get Vehicle Image
        $vehicleImage = VehiclesImage::where(['id' => $id])->first();
        //Get Vehicle Image Paths
        $large_image_path = 'images/backend_images/vehicles/large/';
        $medium_image_path = 'images/backend_images/vehicles/medium/';
        $small_image_path = 'images/backend_images/vehicles/small/';

        //Delete Large Image
        if (file_exists($large_image_path . $vehicleImage->image)) {
            unlink($large_image_path . $vehicleImage->image);
        }

        //Delete medium Image
        if (file_exists($medium_image_path . $vehicleImage->image)) {
            unlink($medium_image_path . $vehicleImage->image);
        }


        //Delete small Image
        if (file_exists($small_image_path . $vehicleImage->image)) {
            unlink($small_image_path . $vehicleImage->image);
        }

        VehiclesImage::where(['id' => $id])->delete();

        return redirect()->back()->with('message_error', 'Vehicle Alternate Image(s) has been deleted Succesfully');
    }
}
