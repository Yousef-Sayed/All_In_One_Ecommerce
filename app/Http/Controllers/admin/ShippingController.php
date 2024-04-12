<?php

namespace App\Http\Controllers\admin;

use App\Models\Shipping;
use App\Models\backend\Logs;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ShippingController extends Controller
{
    public function index(Request $request){
        if($request->ajax())
        {
            $data = Shipping::select('*');

            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn = '<div class=" d-flex align-content-center justify-content-center">';
                $actionBtn .= '<a class="btn-success btn-sm font-weight-bold" href="'. route('shipping.edit',$row->id).'"><i class="far fa-edit"></i>  ' .__('words.edit').'</a>';
                $actionBtn .= '<a class="btn btn-danger text-white btn-sm font-weight-bold"
                                    data-toggle="modal"data-id="'. $row->id .'" id="btnDelete" data-target="#deleteModal">
                                    <i class="far fa-trash-alt"></i>  '.__('words.delete').'
                                </a>
                            </div>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->editColumn('created_at', function ($date) {
                return $date->created_at->format('d-m-Y');
            })
            ->make(true);
        }
        return view('backend.shipping.shipping');
    }

    public function add(Request $request){
        return view('backend.shipping.addShipping');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nameEn' => 'required|min:3|string|unique:shippings,areaEn',
            'nameAr' => 'required|min:3|string|unique:shippings,areaAr',
            'value' => 'required|string|max:10',
        ]);
        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back();
        }
        Shipping::create([
            'areaAr' => $request->nameAr,
            'areaEn' => $request->nameEn,
            'value' => $request->value,
        ]);
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgAddShippingAr'),
                'messageEn' => __('words.msgAddShippingEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        Session::put('sucess', __('words.msgAdd'));
        return redirect()->route('shipping.index');
    }

    public function edit($id){
        $shiping = Shipping::find($id);
        return view('backend.shipping.editShipping',compact('shiping'));
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'nameEn' => 'required|min:3|string|unique:shippings,areaEn,'. $request->id,
            'nameAr' => 'required|min:3|string|unique:shippings,areaAr,'. $request->id,
            'value' => 'required|string|max:10',
        ]);
        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back();
        }
        Shipping::where('id',$request->id)->update([
            'areaAr' => $request->nameAr,
            'areaEn' => $request->nameEn,
            'value' => $request->value,
        ]);
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgUpdateShippingAr'),
                'messageEn' => __('words.msgUpdateShippingEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        Session::put('sucess', __('words.msgUpdate'));
        return redirect()->route('shipping.index');
    }

    public function delete(Request $request){
        if(is_numeric($request->id)){
            $shipping = Shipping::find($request->id);
            $shipping->delete();
            Session::put('sucess', __('words.msgDelete'));
            if(Auth::guard('admin')->user()->role != "-1"){
                Logs::create([
                    'messageAr' => __('words.msgDeletedShippingAr'),
                    'messageEn' => __('words.msgDeletedShippingEn'),
                    'admin_id' => Auth::guard('admin')->user()->id,
                ]);
            }
            return redirect()->back();
        }
    }
}
