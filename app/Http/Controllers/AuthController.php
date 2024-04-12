<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('Auth.login');
    }

    public function loginUser(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back()->withInput();
        }
        if (Auth::guard('web')->attempt(['email' => $request->email,'password' => $request->password,'role' => '0','status' => '1'],$request->remember)) {
            return redirect()->intended(route('homePage'));
        }
        Session::put('loginError', 'Incorrect email address or password ');
        return back()->withInput();
    }

    public function showSignupForm(){
        return view('Auth.register');
    }

    public function signupUser(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|string|unique:users',
            'password' => 'required|min:8|string',
        ]);

        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back()->withInput();
        }else{
            if($request->password == $request->Cpassword){
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'status' => '1',
                    'social_type' => 'system',
                    'profile_photo_path' => 'images/users/profile.png',
                ]);
                Auth::guard('web')->login($user);
                return redirect()->route('homePage');
            }else{
                Session::put('notMatch', __('words.passwordNotMatch'));
                return back()->withInput();
            }
        }
    }

    public function forgot(){
        return view('Auth.frogot');
    }

    public function forgot_password(Request $request){
        $user = User::where('email',$request->email)->where('social_type','system')->first();
        if(! empty($user)){
            $user->remember_token = Str::random(40);
            $user->save();
            Mail::to($user->email)->send(new ResetPassword($user));
            session()->put('sucess', __('words.checkYourEmail'));
            return redirect()->back();
        }else{
            session()->put('erorr',  __('words.emailNotFound') );
            return redirect()->back();
        }
    }

    public function reset($token){
        $user = User::where('remember_token',$token)->first();
        if(!empty($user)){
            $data = $user->id;
            return view('Auth.changePassword',compact('data'));
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
            User::where('id',$request->id)->update([
                'password' => bcrypt($request->password),
                'remember_token' => '',
            ]);
            return redirect()->route('login');
        }else{
            session()->put('erorr',  __('words.passwordNotMatch') );
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        // $request->session()->regenerateToken();
        Auth::guard('web')->logout();
        session()->forget('cart');
        return redirect(route('homePage')); // Redirect to login page after logout
    }
}
