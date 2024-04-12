<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }
    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function hendelGoogleCallback(){
        try{
            $user = Socialite::driver('google')->user();
            $finduser = User::where('social_id',$user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect(route('homePage'));
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id' => $user->id,
                    'profile_photo_path' => $user->avatar,
                    'social_type' => 'google',
                    'status' => '1',
                    'password' => Hash::make('mypassword'),

                ]);

                Auth::guard('web')->login($newUser);
                return redirect(route('homePage'));
            }

        }catch(Exception $e){
            dd($e->getMessage());
        }
    }
    public function hendelFacebookCallback(){
        try{
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('social_id',$user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect(route('homePage'));
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id' => $user->id,
                    'social_type' => 'facebook',
                    'status' => '1',
                    'password' => Hash::make('mypassword'),

                ]);

                Auth::guard('web')->login($newUser);
                return redirect(route('homePage'));
            }

        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

}
