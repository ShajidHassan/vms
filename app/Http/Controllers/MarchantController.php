<?php

namespace App\Http\Controllers;


use App\Account;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MarchantController extends Controller
{

    public function dashboard()
	{
        $this->checkPermission();
	    return view('marchant.dashboard');
	}
    public function transaction()
    {
        $this->checkPermission();
        //$accountNumbers = Account::where("holder_ref", \Illuminate\Support\Facades\Session::get('marchant_id'))->pluck('acc_no')->toArray();
//        $allTransactions = Transaction::whereIn("from_account", $accountNumbers)->orderBy("created_at","DESC")->get();
        $allTransactions = DB::table("transactions")
            ->where("deleted_at", "=", null)
            ->where("trans_for","=","merchant")
            ->orderBy("created_at","DESC")
            ->get();

        return view('marchant.transactions', compact('allTransactions'));
    }

    public function transactionAction($id)
    {
        $this->checkPermission();
        if(intval($id) > 0){
            $transaction = Transaction::where("id","=", intval($id))->first();
            if($transaction != null){
                $action = strtolower($transaction->status) == "pending" ? "completed" : "pending";
                $transaction->status = $action;
                try {
                    $transaction->save();
                } catch (\Exception $exception) {
                    return redirect()->back()->with("message_error", "Transaction status change failed");
                }
                return redirect()->back()->with("message", "Transaction status changed Success");
            }else {
                return redirect()->back()->with("message_error", "Transaction Not Found");
            }
        }else{
            return redirect()->back()->with("message_error", "Invalid parameter supplied");
        }

    }

    public function viewTransaction($id)
    {
        $this->checkPermission();
        if(intval($id) > 0){
            $transaction = Transaction::where("id", intval($id))->first();
            if($transaction === null)
                return redirect()->back()->with('message_error','Transaction Not Found');
            return view('marchant.details-transaction', compact('transaction'));
        }else{
            return redirect()->back()->with('message_error','Request invalid');
        }

    }

    public function addBalance()
    {
        $this->checkPermission();
        return view('marchant.add-balance');
    }

    public function addAccount()
    {
        $this->checkPermission();
        return view('marchant.add-account');
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

    public function postAccount(Request $request)
    {
        if($request->isMethod("POST")){
            $this->checkPermission();
            $holderName = trim(strip_tags($request->input("holder_name")));
            $accountNumber = trim(strip_tags($request->input("acc_number")));
            $bankName = trim(strip_tags($request->input("bank_name")));
            $branchName = trim(strip_tags($request->input("branch_name")));
            $branchAddress = trim(strip_tags($request->input("branch_address")));
            $amount = trim(strip_tags($request->input("amount")));

            $validator = Validator::make($request->except(['_token']), $this->getAccountRule(), $this->getAccountMessage());

            if ($validator->fails()) {
                return redirect()->back()->withInput($request->except(["password"]))->withErrors($validator);
            }

            $isInserted = DB:: table('accounts')->insert(
                [
                    'acc_no' => $accountNumber,
                    'holder_ref' => Session::get('marchant_id'),
                    'holder_name' => $holderName,
                    'holder_type' => "Marchant",
                    'amount' => $amount,
                    'bank_name' => $bankName,
                    'branch_name' => $branchName,
                    'address' => $branchAddress,
                ]);

            if($isInserted)
                return redirect()->back()->with('message', 'Account create Successfully.');
            else
                return redirect()->back()->with('message_error', 'Insertion failed. due to server disconnection');

        }else{
            return redirect()->back()->with('message_error','Request Method invalid');
        }
    }

    public function deleteAccount(Request $request)
    {
        if($request->isMethod("POST")){
            $this->checkPermission();
            $accountId = trim(strip_tags($request->input("acc_id")));

            if(intval($accountId) <= 0)
                return redirect()->back()->with('message_error','Request invalid');

            $account = Account::where("id", intval($accountId))->first();
            if($account === null)
                return redirect()->back()->with('message_error','Account Not Found');

            if($account) {
                $account->deleted_at = Carbon::now();
                try {
                    $account->save();
                    return redirect()->back()->with('message', 'Account deleted Successfully.');
                }catch (\Exception $exception){
                    return redirect()->back()->with('message_error', 'Deletion failed. due to server disconnection');
                }
            }else
                return redirect()->back()->with('message_error', 'Deletion failed. due to server disconnection');

        }else{
            return redirect()->back()->with('message_error','Request Method invalid');
        }
    }

    public function editAccount($id)
    {
        if(intval($id) > 0){
            $this->checkPermission();
            $account = Account::where("id", intval($id))->first();
            if($account === null)
                return redirect()->back()->with('message_error','Account Not Found');
            return view('marchant.edit-account', compact('account'));
        }else{
            return redirect()->back()->with('message_error','Request invalid');
        }

    }

    public function viewAccount($id)
    {
        if(intval($id) > 0){
            $this->checkPermission();
            $account = Account::where("id", intval($id))->first();
            if($account === null)
                return redirect()->back()->with('message_error','Account Not Found');
            return view('marchant.details-account', compact('account'));
        }else{
            return redirect()->back()->with('message_error','Request invalid');
        }

    }

    public function updateAccount(Request $request)
    {
        if($request->isMethod("PUT")){

            $accountId = intval($request->input("id"));
            if($accountId <= 0)
                return redirect()->back()->with('message_error','Request invalid');

            $account = Account::where("id", $accountId)->first();
            if($account == null)
                return redirect()->back()->with('message_error','Account invalid');

            $authId = Session::get('marchant_id');
            if($authId !== $account->holder_ref)
                return redirect()->back()->with('message_error','You are not permitted update this account');

            $holderName = trim(strip_tags($request->input("holder_name")));
            $bankName = trim(strip_tags($request->input("bank_name")));
            $branchName = trim(strip_tags($request->input("branch_name")));
            $branchAddress = trim(strip_tags($request->input("branch_address")));
            $amount = trim(strip_tags($request->input("amount")));

            $validator = Validator::make($request->except(['_token']), $this->getAccountRule(true), $this->getAccountMessage());

            if ($validator->fails()) {
                return redirect()->back()->withInput($request->except(["password"]))->withErrors($validator);
            }

	    try {
                DB:: table('accounts')
                    ->where("id", $accountId)
                    ->update(
                        [
                            'acc_no' => $account->acc_no,
                            'holder_ref' => $account->holder_ref,
                            'holder_name' => $holderName,
                            'amount' => $amount,
                            'bank_name' => $bankName,
                            'branch_name' => $branchName,
                            'address' => $branchAddress,
                        ]);

                return redirect()->back()->with('message', 'Account updated Successfully.');
            }catch (\Exception $exception){
                return redirect()->back()->with('message_error', 'Update failed. due to server disconnection');
            }

        }else{
            return redirect()->back()->with('message_error','Request Method invalid');
        }
    }

    private function getAccountRule($isEdit = false)
    {
        $account =  ['acc_number' => 'required|unique:accounts,acc_no'];
        return array_merge([
            'holder_name' => 'required|min:5',
            'bank_name' => 'required|min:5',
            'branch_name' => 'required|min:5',
            'branch_address' => 'required|min:10',
            'amount' => 'required|numeric|min:500',
        ], $isEdit ? [] : $account);
    }

    private function getAccountMessage()
    {
        return [
            'acc_number.unique' => 'Account already exist'
        ];
    }

    public function account()
    {
        if(Session::get("marchant_id")) {
            $accounts = DB::table("accounts")
                ->where("holder_ref",  "=",Session::get("marchant_id"))
                ->Where("holder_type", "=","Marchant")
                ->where("deleted_at","=", null)
                ->get();
            return view('marchant.account', compact("accounts"));
        }else{
            return redirect()->route("marchant.signin")->with('message_error','Request Method invalid');
        }
    }
}