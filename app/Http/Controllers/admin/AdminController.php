<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index(Request $request){
        if($request->ajax())
        {
            $data = Admin::where('role','1');
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn = '<div class=" d-flex align-content-center justify-content-center">';
                if($row->status == '0'){
                    $actionBtn .= '<a class="btn-success btn-sm font-weight-bold" href="'. route('admins.avtive',$row->id).'"><i class="fas fa-user-check"></i>  ' .__('words.active').'</a>';
                }else{
                    $actionBtn .= '<a class="btn-warning btn-sm font-weight-bold" href="'. route('admins.disAvtive',$row->id).'"><i class="fas fa-power-off"></i>  ' .__('words.disActive').'</a>';
                }
                $actionBtn .= '<a class="btn btn-danger text-white btn-sm font-weight-bold"
                                    data-toggle="modal"data-id="'. $row->id .'" id="btnDelete" data-target="#deleteModal">
                                    <i class="far fa-trash-alt"></i>  '.__('words.delete').'
                                </a>
                            </div>';
                return $actionBtn ;
            })
            ->rawColumns(['action'])
            ->editColumn('created_at', function ($date) {
                return $date->created_at->format('d-m-Y');
            })
            ->addColumn('status',function ($data){
                if($data->status == '1'){
                    return '<div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-circle" style="color: #6cd404; font-size: 14px; margin:0 3px"></i>
                                <span style="font-size: 14px;">'. __("words.actived") .'</span>
                            </div>';
                }else{
                    return '<div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-circle" style="color: #FFD43B; font-size: 14px; margin:0 3px"></i>
                                <span style="font-size: 14px;">'. __("words.pending") .'</span>
                            </div>';
                }
            })
            ->rawColumns(['status','action'])
            ->make(true);
        }
        return view('backend.admins.admins');
    }

    public function active($value){
        Admin::where('id',$value)->update([
            'status' => '1'
        ]);
        return redirect()->back();
    }

    public function disAvtive($value){
        Admin::where('id',$value)->update([
            'status' => '0'
        ]);
        return redirect()->back();
    }
    public function delete(Request $value){
        $admin = Admin::where('id',$value->id)->first();
        $admin->delete();
        Session::put('sucess', __('words.msgDelete'));
        return redirect()->back();
    }
}
