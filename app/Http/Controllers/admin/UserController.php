<?php

namespace App\Http\Controllers\admin;

use App\Models\backend\Logs;
use App\Models\backend\Order;
use App\Models\testimomial;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = User::select('*');
            return DataTables::of($data)->addIndexColumn()
            ->editColumn('created_at', function ($date) {
                return $date->created_at->format('d-m-Y');
            })
            ->addColumn('action',function($row){
                $actionBtn = '<div class=" d-flex align-content-center justify-content-center">';
                $actionBtn .= '<a class="btn btn-danger text-white btn-sm font-weight-bold"
                                    data-toggle="modal"data-id="'. $row->id .'" id="btnDelete" data-target="#deleteModal">
                                    <i class="far fa-trash-alt"></i>  '.__('words.delete').'
                                </a>
                            </div>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('backend.users.users');
    }
    public function delete(Request $request){
        Comment::where('user_id',$request->id)->delete();
        Order::where('user_id',$request->id)->delete();
        Reply::where('user_id',$request->id)->delete();
        testimomial::where('userID',$request->id)->delete();
        User::find($request->id)->delete();
        if(Auth::guard('admin')->user()->role != -1){
            Logs::create([
                'messageAr' => __('words.msgDeleteUserAr'),
                'messageEn' => __('words.msgDeleteUserEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        Session::put('sucess', __('words.msgDelete'));
        return redirect()->back();
    }
}
