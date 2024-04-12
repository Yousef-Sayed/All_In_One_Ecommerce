<?php

namespace App\Http\Controllers;

use App\Models\testimomial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    public function index(){
        return view('frontend.testimonial');
    }
    public function storeTestimonial(Request $request){
        $validator = Validator::make($request->all(), [
            'testimoialEn' => 'required|min:2|string',
        ]);
        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back();
        }
        testimomial::create([
            'testimonialEn' => $request->testimoialEn,
            'testimonialAr' => $request->testimoialEn,
            'userID' => Auth::guard('web')->user()->id,
        ]);
        Session::put('sucess', __('words.msgAddOpinion'));
        return redirect()->route('homePage');
    }
}
