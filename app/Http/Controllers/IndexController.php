<?php

namespace App\Http\Controllers;


use App\Category;
use App\VehiclesImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    public function index(){

        //In descending Order
        $vehiclesAll = DB::table("vehicles")
            ->join("solds","solds.vechicle_id", "=", "vehicles.id")
            ->where('vehicles.deleted_at','=', null)
            ->where('solds.action','=', "on")
            ->selectRaw("vehicles.*,solds.sold_qty, solds.booking_rate,solds.sale_price,solds.show_room, solds.address, solds.phone AS contact, solds.booking_status")
            ->orderBy('id','DESC')
            ->paginate(6);

        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        return view('index')->with(compact('vehiclesAll','categories'));
    }


    //============ all vehicles public action =========

    public function vehicles($url = null){
        $countCategory = Category::where(['url'=>$url])->count();
        if($countCategory==0){
            abort(404);
        }

        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        $categoryDetails = Category::where(['url' => $url])->first();

        if($categoryDetails->parent_id == 0){
            $subCategories = Category::where(['parent_id'=>$categoryDetails->id])->get();
            foreach($subCategories as $subcat){
                $cat_ids[] = $subcat->id;
            }

            $vehiclesAll = DB::table("vehicles")
                ->join("solds","solds.vechicle_id", "=", "vehicles.id")
                ->where('vehicles.deleted_at','=', null)
                ->where('solds.action','=', "on")
                ->whereIn("category_id",$cat_ids)
                ->selectRaw("vehicles.*,solds.sold_qty, solds.booking_rate,solds.sale_price,solds.show_room, solds.address, solds.phone AS contact, solds.booking_status")
                ->orderBy('id','DESC')
                ->distinct()->paginate(3);
        }else{
            $vehiclesAll = DB::table("vehicles")
                ->join("solds","solds.vechicle_id", "=", "vehicles.id")
                ->where('vehicles.deleted_at','=', null)
                ->where('solds.action','=', "on")
                ->where("category_id","=",$categoryDetails->id)
                ->selectRaw("vehicles.*,solds.sold_qty, solds.booking_rate,solds.sale_price,solds.show_room, solds.address, solds.phone AS contact, solds.booking_status")
                ->orderBy('id','DESC')
                ->distinct()->paginate(3);
        }

        return view('vehicles.listing')->with(compact('categories','categoryDetails','vehiclesAll'));
    }

    public function vehicle($id= null){

        //Get Vehicle Details
        $vehicleDetails = DB::table("vehicles")
            ->join("solds","solds.vechicle_id", "=", "vehicles.id")
            ->where('vehicles.deleted_at','=', null)
            ->where('solds.action','=', "on")
            ->where('vehicles.id', "=", $id)
            ->selectRaw("vehicles.*,solds.sold_qty, solds.booking_rate,solds.sale_price,solds.show_room, solds.address, solds.phone AS contact, solds.booking_status")
            ->first();

        //In descending Order
        $relatedVehicles = DB::table("vehicles")
            ->join("solds","solds.vechicle_id", "=", "vehicles.id")
            ->where('vehicles.deleted_at','=', null)
            ->where('solds.action','=', "on")
            ->where("vehicles.category_id", "=", $vehicleDetails->category_id)
            ->selectRaw("vehicles.*,solds.sold_qty, solds.booking_rate,solds.sale_price,solds.show_room, solds.address, solds.phone, solds.booking_status")
            ->orderBy('id','DESC')
            ->get();

        //Get all categories and subcategories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        //get vehicle Alternate Images
        $vehicleAltImages = VehiclesImage::where('vehicle_id',$id)->get();

        return view('vehicles.detail')->with(compact('vehicleDetails','categories','vehicleAltImages','relatedVehicles'));
    }

    public function searchVehicles(Request $request){
        if($request->isMethod('get')){
            $data = $request->all();
            $categories = Category::with('categories')->where(['parent_id' => 0])->get();

            $search_vehicle = $data['vehicle'];

            $vehiclesAll = DB::table("vehicles")
                ->join("solds","solds.vechicle_id", "=", "vehicles.id")
                ->where('vehicles.deleted_at','=', null)
                ->where('solds.action','=', "on")
                ->where('vehicles.brand','like','%'.$search_vehicle.'%')
                ->orwhere('vehicles.model',$search_vehicle)
                ->orwhere('vehicles.year',$search_vehicle)
                ->orwhere('solds.show_room',$search_vehicle)
                ->selectRaw("vehicles.*,solds.sold_qty, solds.booking_rate,solds.sale_price,solds.show_room, solds.address, solds.phone AS contact, solds.booking_status")
                ->orderBy('id','DESC')
                ->paginate(3);

            return view('vehicles.listing')->with(compact('categories','search_vehicle','vehiclesAll'));
        }
    }

    public function PriceRange1(Request $request){

        $vehiclesAll = DB::table('vehicles')
            ->join("solds","solds.vechicle_id", "=", "vehicles.id")
            ->where('vehicles.deleted_at','=', null)
            ->where('solds.action','=', "on")
            ->where('solds.sale_price','<=','1000000')
            ->distinct()->get();

        //Get all categories and sub categories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        return view('vehicles.PriceRange1')->with(compact('vehiclesAll','categories'));
    }

    public function PriceRange2(Request $request){

        $vehiclesAll =DB::table('vehicles')
            ->join("solds","solds.vechicle_id", "=", "vehicles.id")
            ->where('solds.sale_price','<=','2000000')
            ->where('vehicles.deleted_at','=', null)
            ->where('solds.action','=', "on")
            ->selectRaw("vehicles.*,solds.sold_qty, solds.booking_rate,solds.sale_price,solds.show_room, solds.address, solds.phone AS contact, solds.booking_status")
            ->distinct()->get();

        //Get all categories and sub categories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        return view('vehicles.PriceRange2')->with(compact('vehiclesAll','categories'));
    }

    public function PriceRange3(Request $request){
        $vehiclesAll =DB::table('vehicles')
            ->join("solds","solds.vechicle_id", "=", "vehicles.id")
            ->where('solds.sale_price','<=','3000000')
            ->where('vehicles.deleted_at','=', null)
            ->where('solds.action','=', "on")
            ->selectRaw("vehicles.*,solds.sold_qty, solds.booking_rate,solds.sale_price,solds.show_room, solds.address, solds.phone AS contact, solds.booking_status")
            ->distinct()->get();

        //Get all categories and sub categories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        return view('vehicles.PriceRange3')->with(compact('vehiclesAll','categories'));
    }

    public function PriceRange4(Request $request){
        $vehiclesAll =DB::table('vehicles')
            ->join("solds","solds.vechicle_id", "=", "vehicles.id")
            ->where('solds.sale_price','<=','5000000')
            ->where('vehicles.deleted_at','=', null)
            ->where('solds.action','=', "on")
            ->selectRaw("vehicles.*,solds.sold_qty, solds.booking_rate,solds.sale_price,solds.show_room, solds.address, solds.phone AS contact, solds.booking_status")
            ->distinct()->get();

        //Get all categories and sub categories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        return view('vehicles.PriceRange4')->with(compact('vehiclesAll','categories'));
    }

    public function PriceRange5(Request $request){
        $vehiclesAll =DB::table('vehicles')
            ->join("solds","solds.vechicle_id", "=", "vehicles.id")
            ->where('solds.sale_price','>=','5000000')
            ->where('vehicles.deleted_at','=', null)
            ->where('solds.action','=', "on")
            ->selectRaw("vehicles.*,solds.sold_qty, solds.booking_rate,solds.sale_price,solds.show_room, solds.address, solds.phone AS contact, solds.booking_status")
            ->distinct()->get();

        //Get all categories and sub categories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        return view('vehicles.PriceRange5')->with(compact('vehiclesAll','categories'));
    }

}
