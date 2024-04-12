<?php

namespace App\Http\Controllers\admin\auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\EmailVirification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;

class AdminRegisterController extends Controller
{
    public function index(){
        return view('Auth.admin.register');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            // 'name' => 'required|string|min:2|max:30|unique:admins|regex:/^[a-zA-Z0-9_]+$/',
            // 'email' => 'required|email|string|unique:admins',
            // 'password' => 'required|min:8|string',
        ]);

        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back()->withInput();
        }else{
            if($request->password == $request->Cpassword){
                Admin::create([
                    'name' => strtolower($request->name),
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'status' => '0',
                    'role' => '1',
                    'profile_photo_path' => 'images/users/admins/profile.png',
                ]);
                // return redirect()->intended(route('admin.login'));
                $email = $request->email;
                return redirect()->route('admin.VerificationEmail',compact('email'));
            }else{
                Session::put('notMatch', __('words.passwordNotMatch'));
                return back()->withInput();
            }
        }
    }
    public function verificationEmail($request){
        Mail::to($request)->send(new EmailVirification($request));
        return view('Auth.admin.verificationEmail',compact('request'));
    }
    public function verified($email){
        Admin::where('email',$email)->update([
            'email_verified_at' => now()
        ]);
        return redirect()->route('admin.login');
    }
    public function registerWithAdmin(){
        return view('Auth.admin.registerWithAdmin');
    }
    public function sroreWithAdmin(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:30|unique:admins|regex:/^[a-zA-Z0-9_]+$/',
            'email' => 'required|email|string|unique:admins',
            'password' => 'required|min:8|string',
        ]);
        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back()->withInput();
        }else{
            if($request->password == $request->Cpassword){
                Admin::create([
                    'name' => strtolower($request->name),
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'status' => '1',
                    'role' => '1',
                    'profile_photo_path' => 'images/users/admins/profile.png',
                ]);
                return redirect()->route('admins');
            }else{
                Session::put('notMatch', __('words.passwordNotMatch'));
                return back()->withInput();
            }
        }
    }
}
