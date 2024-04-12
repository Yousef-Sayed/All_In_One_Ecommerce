<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function profile(){
        return view('Auth.profile');
    }
    public function updateProfile(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|string|unique:users,name,'. Auth::user()->id,
            'email' => 'required|email',
            'password' => 'min:8|string|nullable',
            'image' => 'nullable|image',
        ]);
        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back();
        }
        if (is_null($request->password)) {
            User::where('id',Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }else{
            User::where('id',Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
        }
        if($request->image != null){
            $file = $request->file('image');
            $filename = Str::uuid(). '-' . $file->getClientOriginalName();
            $file->move(public_path('images/users/'),$filename);
            $path = "images/users/" . $filename;
            if(basename(Auth::user()->profile_photo_path) != 'profile.png'){
                unlink(public_path(Auth::user()->profile_photo_path));
            }
            User::where('id',Auth::user()->id)->update([
                'profile_photo_path' => $path,
            ]);
        }

        Session::put('sucess', __('words.msgUpdate'));
        return redirect()->route('profileUser');
    }
}
