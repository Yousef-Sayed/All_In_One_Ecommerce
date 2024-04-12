<?php

namespace App\Http\Controllers\Admin;

use App\Models\testimomial;
use App\Models\backend\Logs;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TestimoialController extends Controller
{
    public function index(Request $request){
        if($request->ajax())
        {
            $data = testimomial::get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn = '<div class=" d-flex align-content-center justify-content-center">';
                if($row->show == '0'){
                    $actionBtn .= '<a class="btn-success btn-sm font-weight-bold" href="'. route('admin.testimonial.avtive',$row->id).'"><i class="fas fa-eye"></i>  ' .__('words.show').'</a>';
                }else{
                    $actionBtn .= '<a class="btn-warning btn-sm font-weight-bold" href="'. route('admin.testimonial.disAvtive',$row->id).'"><i class="fas fa-eye-slash"></i>  ' .__('words.hide').'</a>';
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
            ->addColumn('show',function ($data){
                if($data->show == '1'){
                    return '<div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-circle" style="color: #6cd404; font-size: 14px; margin:0 3px"></i>
                                <span style="font-size: 14px;">'. __("words.visiable") .'</span>
                            </div>';
                }else{
                    return '<div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-circle" style="color: #FFD43B; font-size: 14px; margin:0 3px"></i>
                                <span style="font-size: 14px;">'. __("words.invisible") .'</span>
                            </div>';
                }
            })
            ->rawColumns(['show','action'])
            ->make(true);
        }
        return view('backend.testimonials.testimonial');
    }

    public function active($value){
        testimomial::where('id',$value)->update([
            'show' => '1'
        ]);
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgShowCommentAr'),
                'messageEn' => __('words.msgShowCommentEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        return redirect()->back();
    }

    public function disAvtive($value){
        testimomial::where('id',$value)->update([
            'show' => '0'
        ]);
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgHideCommentAr'),
                'messageEn' => __('words.msgHideCommentEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        return redirect()->back();
    }

    public function delete(Request $value){
        $testimonial = testimomial::where('id',$value->id)->first();
        $testimonial->delete();
        Session::put('sucess', __('words.msgDelete'));
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgDeleteCommentAr'),
                'messageEn' => __('words.msgDeleteCommentEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        return redirect()->back();
    }
}
