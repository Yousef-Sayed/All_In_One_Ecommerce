<?php

namespace App\Http\Controllers\admin\auth;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\resetPasswordAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    public function index(){
        return view('Auth.admin.login');
    }
    public function checkLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|min:8',
        ]);

        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back()->withInput();
        }
        $data = Admin::where('name',$request->username)->first();
        // dd($data->profile_photo_path);
        if(is_null($data->email_verified_at)){
            $email = $data->email;
            return redirect()->route('admin.VerificationEmail',compact('email'));
        }
        if (Auth::guard('admin')->attempt(['name' => strtolower($request->username),'password' => $request->password,'role' => ['1','-1'],'status' => '1'])) {
            return redirect()->intended(route('admin.home'));
        }
        // abort_if($data->role != '1' || $data->role != '-1', 401);
        if($data->role != '1' || $data->role != '-1'){
            abort(401);
        }
        if($data->status != '1'){
            Session::put('loginError',__('words.notActivedMessage'));
            return redirect()->back();
        }
    }

    public function forgot(){
        return view('Auth.admin.frogot');
    }

    public function forgot_password(Request $request){
        $admin = Admin::where('email',$request->email)->first();
        if(! empty($admin)){
            $admin->remember_token = Str::random(40);
            $admin->save();
            Mail::to($admin->email)->send(new resetPasswordAdmin($admin));
            session()->put('sucess', __('words.checkYourEmail'));
            return redirect()->back();
        }else{
            session()->put('erorr',  __('words.emailNotFound') );
            return redirect()->back();
        }
    }

    public function reset($token){
        $admin = Admin::where('remember_token',$token)->first();
        if(!empty($admin)){
            $data = $admin->id;
            return view('Auth.admin.changePassword',compact('data'));
        }else{
            return view('frontend.404');
        }
    }

    public function UpdatePassword(Request $request){
        $validator = Validator::make($request->all(), [
        'password' => 'required|min:8|string',
        'Cpassword' => 'required|min:8|string',
        ]);
        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back();
        }
        if($request->password == $request->Cpassword){
            Admin::where('id',$request->id)->update([
                'password' => bcrypt($request->password),
                'remember_token' => '',
            ]);
            return redirect()->route('admin.login');
        }else{
            session()->put('erorr',  __('words.passwordNotMatch') );
            return redirect()->back();
        }
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
