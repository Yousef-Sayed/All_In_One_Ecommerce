<?php

namespace App\Http\Controllers\admin;

use DateTime;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\backend\Order;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminHomeController extends Controller
{
    public function index(){
        $ordersData = Order::select('order_code', DB::raw('sum(order_total) as total_amount'), DB::raw('max(month(created_at)) as recent_order_month'))
                ->where('order_status','1')
                ->groupBy('order_code')
                ->orderBy('created_at', 'asc')
                ->get();
        $data = $ordersData->toArray();
        $output = [
            'labels' => [],
            'data' => [],
        ];
        foreach ($data as $daa) {
            $monthNum  = $daa['recent_order_month'];
            $dateObj   = DateTime::createFromFormat('!m', $monthNum);
            $monthName = $dateObj->format('F');
            $output['labels'][] = $monthName;
            $output['data'][] = $daa['total_amount'];
        }
        return view('backend.dashboard',compact('output'));
    }
    public function profile(){
        return view('backend.profile');
    }
    public function updateProfileAdmin(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:30|unique:admins,name,'.Auth::guard('admin')->user()->id.'|regex:/^[a-zA-Z0-9_]+$/',
            'email' => 'required|email',
            'password' => 'min:8|string|nullable',
            'image' => 'nullable|image',
        ]);
        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back();
        }
        if (is_null($request->password)) {
            Admin::where('id',Auth::guard('admin')->user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }else{
            Admin::where('id',Auth::guard('admin')->user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
        }
        if($request->image != null){
            $file = $request->file('image');
            $filename = Str::uuid(). '-' . $file->getClientOriginalName();
            $file->move(public_path('images/users/admins/'),$filename);
            $path = "images/users/admins/" . $filename;
            if(basename(Auth::guard('admin')->user()->profile_photo_path) != 'profile.png'){
                unlink(public_path(Auth::guard('admin')->user()->profile_photo_path));
            }
            Admin::where('id',Auth::guard('admin')->user()->id)->update([
                'profile_photo_path' => $path,
            ]);
        }

        Session::put('sucess', __('words.msgUpdate'));
        return redirect()->route('admin.profile');
    }
}
