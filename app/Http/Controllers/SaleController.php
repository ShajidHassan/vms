<?php

namespace App\Http\Controllers;

use App\Sold;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Vehicle;


class SaleController extends Controller
{

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

    public function saleAction($id, $vid)
    {
        $this->checkPermission();
        if(intval($id) > 0 && intval($vid) > 0){
            $sale = Sold::where("id","=", intval($id))->first();
            if($sale != null){
                $action = $sale->action == "off" ? "on" : "off";
                $sale->action = $action;
                try {
                    DB::table("solds")->where([
                        "vechicle_id" => $vid
                    ])->update(["action" => "off"]);
                    $sale->save();
                } catch (\Exception $exception) {
                    return redirect()->back()->with("message_error", "Sale ".$action." failed");
                }
                return redirect()->back()->with("message", "Sale ". $action." Success");
            }else {
                return redirect()->back()->with("message_error", "Sale Not Found");
            }
        }else{
            return redirect()->back()->with("message_error", "Invalid parameter supplied");
        }

    }

    public function saleEdit($id)
    {
        $this->checkPermission();
        if(intval($id) > 0){
            $sale = Sold::where("id","=", intval($id))->first();
            $accounts = DB::table("accounts")
                ->where("holder_ref", "=", Session::get("marchant_id"))
                ->Where("holder_type", "=", "Marchant")
                ->where("deleted_at", "=", null)
                ->pluck('acc_no', 'id')->toArray();
            return view('marchant.sale-edit')->with(compact('sale','accounts'));
        }else{
            return redirect()->back()->with("message_error", "Invalid parameter supplied");
        }

    }

    public function saleUpdate(Request $request)
    {
        $this->checkPermission();
        if($request->isMethod("POST")){
            $id = intval($request->input("s_id"));
            if(intval($id) > 0){
                $sold = Sold::where("id","=", intval($id))->first();
                if($sold == null)
                    return redirect()->back()->with("message_error", "Sale not available");

                $accountKey = intval($request->input("account_key"));
                if($accountKey <= 0){
                    return redirect()->back()->with("message_error", "Invalid account supplied");
                }

                $account = DB::table("accounts")
                    ->where("holder_ref", "=", intval(Session::get("marchant_id")))
                    ->Where("holder_type", "=", "Marchant")
                    ->where("deleted_at", "=", null)
                    ->where('id', '=', $accountKey)->first();

                if($account == null)
                    return redirect()->back()->with("message_error", "Account Missing");

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
                    return redirect()->back()->with("message_error", "Vechicle update failed");
                }
                return redirect()->back()->with("message", "Vechicle update successfully");
            }else{
                return redirect()->back()->with("message_error", "Invalid parameter supplied");
            }
        }else{
            return redirect()->back()->with("message_error", "Invalid request");
        }
    }

    public function saleDelete(Request $request)
    {
        $this->checkPermission();
        if($request->isMethod("POST")) {
            $id = intval($request->input("s_id"));
            if ($id > 0) {
                $sale = Sold::where("id",$id)->first();
                if ($sale != null) {
                    $sale->deleted_at = Carbon::now();
                    try {
                        $sale->save();
                    } catch (\Exception $exception) {
                        return redirect()->back()->with("message_error", "Sale trashed failed");
                    }
                    return redirect()->back()->with("message", "Sale Trashed success");
                }else
                    return redirect()->back()->with("message_error", "Sale Not Found");
            } else {
                return redirect()->back()->with("message_error", "Invalid parameter supplied");
            }
        }else{
            return redirect()->back()->with("message_error", "Request Invalid");
        }

    }

    public function saleDetails($id)
    {
        $this->checkPermission();
        if(intval($id) > 0){
            $sale = Sold::where("id","=", intval($id))->first();
            return view('marchant.sale-details')->with(compact('sale'));
        }else{
            return redirect()->back()->with("message_error", "Invalid parameter supplied");
        }

    }

}
