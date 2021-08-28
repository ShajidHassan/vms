<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{

    public function signin()
    {
        return view('frontend.admin.signin');
    }

    public function signup()
    {
        return view('frontend.admin.signup');
    }

    public function loginPost(Request $request)
    {
        if($request->isMethod("POST")) {
            $validator = Validator::make($request->all(), ['email' => 'required|email', 'password' => 'required']);

            if ($validator->fails()) {
                return redirect()->back()->withInput($request->only(["email"]))->withErrors($validator);
            }
            if ($this->attempt($request)) {
                //dd($request->all());
                return redirect()->route("admin.dashbord");
            } else {
                return redirect()->back()->with('message_error', 'invalid password or email.');
            }
        }else{
            return redirect()->back()->with('message_error','Request Method invalid');
        }

    }

    private function attempt(Request $request)
    {
        $email = trim(strip_tags($request->input("email")));
        $password = trim(strip_tags($request->input("password")));
        $user = Admin::where('email', '=', $email)->first();

        if ($user != null && Hash::check($password, $user->password)) {
            Session::put('admin_id', $user->id);
            Session::put('admin_name', $user->name);
            Session::put('admin_email', $user->email);
            DB::table("admins")->where('email',"=", $email)->update([
                'isLogin'=>true
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function signUpPost(Request $request)
    {
        if($request->isMethod("POST")){
            $name = trim(strip_tags($request->input("name")));
            $email = trim(strip_tags($request->input("email")));
            $password = trim(strip_tags($request->input("password")));
            $c_password = trim(strip_tags($request->input("confirm_password")));

            if(!$request->has("agree-term") || empty($request->input("agree-term"))){
                return redirect()->back()->with('message_error','You must accept our terms and condition');
            }

            $validator = Validator::make($request->all(), $this->getRegisterRule(), $this->getRegisterMessage());

            if ($validator->fails()) {
                return redirect()->back()->withInput($request->except(["password"]))->withErrors($validator);
            }

            if($password !== $c_password){
                return redirect()->back()->with('message_error','Password not match');
            }

            $isInserted = DB:: table('admins')->insert(
                [
                    'name' => $name,
                    'email' => $email,
                    'gender' => trim(strip_tags($request->gender)),
                    'password' => Hash::make($password),
                ]);

            if($isInserted)
                return redirect()->back()->with('message', 'Register Successfully. You can login now');
            else
                return redirect()->back()->with('message_error', 'Insertion failed. due to server disconnection');

        }else{
            return redirect()->back()->with('message_error','Request Method invalid');
        }
    }

    private function getRegisterRule()
    {
        return [
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8',
            'name' => 'required',
            'gender' => 'required',
        ];
    }

    private function getRegisterMessage()
    {
        return [
            'email.unique' => 'Email already exist',
            'email.required' => 'Email is required',
            'name' =>'name is required',
            'gender' =>'gender is required',
        ];
    }

    public function logout(Request $request){
        $email =  Session::get('admin_email');
        DB::table("admins")
            ->where('email',"=", $email)
            ->update([
            'isLogin'=> false
            ]);
        $request->session()->invalidate();
        $request->session()->flush();
        return redirect()->route("home.index");
    }
}
