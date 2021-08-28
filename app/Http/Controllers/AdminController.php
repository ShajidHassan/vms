<?php


namespace App\Http\Controllers;
use App\Account;
use App\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\admin;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
	public function dashboard()
	{
	    $this->checkPermission();

	    $todayTransaction = DB::table("vehicles")
            ->join("transactions","transactions.vechicle_id","=","vehicles.id")
            ->where("vehicles.deleted_at","=", null)
            ->whereDate("transactions.created_at", "=",Carbon::today())
            ->get()->count();

        $totalTransaction = DB::table("vehicles")
            ->join("transactions","transactions.vechicle_id","=","vehicles.id")
            ->where("vehicles.deleted_at","=", null)
            ->get()->count();

        $totalMarchant = DB::table("admins")
            ->where("type","=", "Admin")
            ->get()->count();

        $totalProfit = DB::table("transactions")
            ->where("deleted_at","=", null)
            ->where("trans_for","=","super-admin")
            ->where("trans_type","=","tax")
            ->selectRaw("trans_for, SUM(net_amount) AS totalProfit")
            ->groupBy("transactions.trans_for")
            ->first();

        $todayProfit = DB::table("transactions")
            ->where("deleted_at","=", null)
            ->where("trans_for","=","super-admin")
            ->where("trans_type","=","tax")
            ->whereDate("created_at", "=", Carbon::today())
            ->selectRaw("trans_for, SUM(net_amount) AS todayProfit")
            ->groupBy("transactions.trans_for")
            ->first();

	    return view('admin.dashboard', compact('todayTransaction', 'totalTransaction', 'totalMarchant', 'totalProfit','todayProfit'));
	}

	public function viewAdmin($id=null){
        $admin = DB::table("admins")
            ->join("accounts", "admins.id","=","accounts.holder_ref")
            ->where("accounts.holder_type","=", "Marchant")
            ->where("admins.deleted_at","=", null)
            ->where("admins.id", "=", intval($id))
            ->select("admins.*")
            ->orderBy("accounts.amount","DESC")
            ->first();
	  	return view('admins.view-admin')->with(compact("admin"));
	}

    public function accountAction($id)
    {

        $this->checkPermission();
        if(intval($id) > 0){
            $account = Account::where("id","=", intval($id))->first();
            if($account != null){
                $action = $account->isDefault ? 0 : 1;
                DB::table("accounts")->where([
                    "holder_ref" => Session::get("admin_id"),
                    "holder_type" => "Super Admin",
                ])->update(["isDefault" => 0]);
                try {
                    $account->isDefault = $action;
                    $account->save();

                    $accountIsAnyActive = DB::table("accounts")
                        ->where("isDefault", "=",1)
                        ->where("holder_ref", "=", Session::get("admin_d"))
                        ->where("holder_type","=", "Super Admin")
                        ->get()->count();

                    if($accountIsAnyActive <= 0) {
                        $account->isDefault = 1;
                        $account->save();
                    }

                    return redirect()->back()->with("message", "Account no: ".$account->acc_no." set ". ($action ? 'Active' : 'In-Active'));

                } catch (\Exception $exception) {
                    return redirect()->back()->with("message_error", "Account actived failed");
                }

            }else {
                return redirect()->back()->with("message_error", "Account Not Found");
            }
        }else{
            return redirect()->back()->with("message_error", "Invalid parameter supplied");
        }

    }

    public function viewAdmins(){
	    $this->checkPermission();
        $admins = DB::table("admins")
            ->join("accounts", "admins.id","=","accounts.holder_ref")
            ->where("accounts.holder_type","=", "Marchant")
            ->where("admins.deleted_at","=", null)
            ->select("admins.*")
            ->orderBy("accounts.amount","DESC")
            ->get();
        return view('admin.admins')->with(compact("admins"));
    }

	public function addAdmin(Request $request){
	   	if($request->isMethod('post')){
	   		$data = $request->all();
	   		$adminCount = Admin::where('name', $data['name'])->count();
	   		if($adminCount > 0){
	   			return redirect()->back()->with('flash_message_error','Admin Already Exist! please choose antoher.');
	   		}

            $emailExists = Admin::where('email', $data['email'])->count();
            if( $emailExists > 0){
                return redirect()->back()->with('flash_message_error','Email Already Exist! please choose antoher.');
            }

            if(empty($data['categories_access'])){
	   				$data['categories_access'] = 0;
            }
            if(empty($data['vehicles_access'])){
	   				$data['vehicles_access'] = 0;
            }
            if(empty($data['status'])){
	   				$data['status'] = 0;
            }

            $admin = new Admin;
            $admin->name = $data['name'];
            $admin->email = $data['email'];
            $admin->pass = bcrypt($data['pass']);
            $admin->card_number = $data['acc_no'];
            $admin->holder_name = $data['acc_holder_name'];
            $admin->status = $data['status'];
            $admin->save();
//            if($admin->save()){
//                $account = new Account();
//                $account->acc_no = $data['acc_no'];
//                $account->holder_ref = $admin->id;
//                $account->holder_name = $data['acc_holder_name'];
//                $account->amount = $data['acc_amount'];
//                $account->holder_type ="Admin";
//                $account->save();
//                return redirect()->back()->with('flash_message_success','Admin Added Successfully.');
//            }
        }
	  	return view('backend.admins.add-admin');
	}

	public function editAdmin(Request $request,$id){

        $adminDetails = Admin::where('id',$id)->first();
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['categories_access'])){
                $data['categories_access'] = 0;
            }
            if(empty($data['vehicles_access'])){
                $data['vehicles_access'] = 0;
            }
            if(empty($data['status'])){
                $data['status'] = 0;
            }

            Admin::where(['id'=>$id])->update(
                [
                'name'=>$data['name'],
                'email'=>$data['email'],
                'pass'=> Hash::make($data['pass']),
                'status'=>$data['status'],
                'categories_access'=>$data['categories_access']
                ]
            );
            return redirect()->back()->with('flash_message_success','Admin Updated Successfully.');
	   	 }

	   	 return view('backend.admins.edit-admin')->with(compact("adminDetails"));
	}

	public function deleteAdmin(Request $request){
        if ($request->isMethod('POST')) {
            $id = intval($request->ad_id);
            if (intval($id) > 0) {
                $admin = Admin::where("id", $id)->first();
                if ($admin == null)
                    return redirect()->back()->with("message_error", "Admin not found");

                $admin->deleted_at = Carbon::now();
                $admin->save();

                return redirect()->back()->with('message', 'Admin deleted Succesfully');
            }
        }else{
            return redirect()->back()->with('message', 'Invalid Request');
        }
	}

    public function viewProfit(){

     	$profits = DB::table('vehicles')
                    ->join('admins','vehicles.admin_id','=','admins.id')
                    ->where ('admin_id','=', Session::get('userid'))
                    ->select('brand','model','selling','purchase')->get();

     	$TotalProfit = DB::table('vehicles')
                      ->join('admins','vehicles.admin_id','=','admins.id')
                      ->where ('admin_id','=', Session::get('userid'))
                      ->sum(DB::raw('selling - purchase'));

     	return view('backend.profit.profit')->with(compact('profits','TotalProfit'));
	}

    public function transaction()
    {
        $this->checkPermission();
//        $accountNumbers = Account::where("holder_ref", Session::get('user_id'))->pluck('acc_no')->toArray();
//        $allTransactions = Transaction::whereIn("from_account", $accountNumbers)->orderBy("created_at","DESC")->get();
        $allTransactions = Transaction::where("trans_by", Session::get('admin_id'))
            ->orWhere("trans_for", "supper-admin")
            ->orderBy("created_at","DESC")->get();
        return view('admin.transactions', compact('allTransactions'));
    }

    public function viewTransaction($id)
    {
        $this->checkPermission();
        if(intval($id) > 0){
            $transaction = Transaction::where("id", intval($id))->first();
            if($transaction === null)
                return redirect()->back()->with('message_error','Transaction Not Found');
            return view('users.details-transaction', compact('transaction'));
        }else{
            return redirect()->back()->with('message_error','Request invalid');
        }

    }

    public function addBalance()
    {
        $this->checkPermission();
        return view('users.add-balance');
    }

    public function addAccount()
    {
        return view('admin.add-account');
    }

    public function postAccount(Request $request)
    {
        $this->checkPermission();
        if($request->isMethod("POST")){
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
                    'holder_ref' => Session::get('admin_id'),
                    'holder_name' => $holderName,
                    'holder_type' => "Super Admin",
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
        $this->checkPermission();
        if($request->isMethod("POST")){
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
        $this->checkPermission();
        if(intval($id) > 0){
            $account = Account::where("id", intval($id))->first();
            if($account === null)
                return redirect()->back()->with('message_error','Account Not Found');
            return view('admin.edit-account', compact('account'));
        }else{
            return redirect()->back()->with('message_error','Request invalid');
        }

    }

    public function viewAccount($id)
    {
        $this->checkPermission();
        if(intval($id) > 0){
            $account = Account::where("id", intval($id))->first();
            if($account === null)
                return redirect()->back()->with('message_error','Account Not Found');
            return view('users.details-account', compact('account'));
        }else{
            return redirect()->back()->with('message_error','Request invalid');
        }

    }

    public function updateAccount(Request $request)
    {
        $this->checkPermission();
        if($request->isMethod("PUT")){
            $accountId = intval($request->input("id"));
            if($accountId <= 0)
                return redirect()->back()->with('message_error','Request invalid');

            $account = Account::where("id", $accountId)->first();
            if($account == null)
                return redirect()->back()->with('message_error','Account invalid');

            $authId = Session::get('admin_id');
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

            $isInserted = DB:: table('accounts')->where("id", $accountId)->update(
                [
                    'acc_no' => $account->acc_no,
                    'holder_ref' => $account->holder_ref,
                    'holder_name' => $holderName,
                    'amount' => $amount,
                    'bank_name' => $bankName,
                    'branch_name' => $branchName,
                    'address' => $branchAddress,
                ]);

            if($isInserted)
                return redirect()->back()->with('message', 'Account updated Successfully.');
            else
                return redirect()->back()->with('message_error', 'Update failed. due to server disconnection');

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
        $this->checkPermission();
        if(Session::get("admin_id")) {
            $accounts = DB::table("accounts")
                ->where("holder_ref",  "=",Session::get("admin_id"))
                ->Where("holder_type", "=","Super Admin")
                ->where("deleted_at","=", null)
                ->get();
            return view('admin.account', compact("accounts"));
        }else{
            return redirect()->back()->with('message_error','Request Method invalid');
        }
    }

    public function checkPermission(){
        $permissionId = intval(Session::get('admin_id'));
        if($permissionId <= 0){
            return redirect()->back()->with('message_error','You must be login first');
        }

        $marChantExists = DB::table("admins")
            ->where("deleted_at","=", null)
            ->where("id", "=", $permissionId)->first();

        if($marChantExists === null){
            return redirect()->back()->with('message_error','You must be signup first');
        }
    }


}