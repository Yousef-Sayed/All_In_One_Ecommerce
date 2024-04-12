<?php

namespace App\Http\Controllers\admin;

use App\Models\backend\Logs;
use Illuminate\Http\Request;
use App\Models\backend\Order;
use App\Models\backend\Prodecut;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Order::groupBy('user_id','shipping_name','order_code','order_status','created_at')
                            ->select('user_id','shipping_name','order_code','order_status','created_at')
                            ->selectRaw('sum(quantity) as product_count, sum(order_total) as total_amount')
                            ->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn = '<div class=" d-flex align-content-center justify-content-center">';
                $actionBtn .= '<a class="btn-success btn-sm font-weight-bold" href="'. route('orders.show',$row->order_code).'"><i class="far fa-edit"></i>  ' .__('words.orderDetails').'</a>';
                $actionBtn .= '<a class="btn btn-danger text-white btn-sm font-weight-bold"
                                    data-toggle="modal"data-id="'. $row->order_code .'" id="btnDelete" data-target="#deleteModal">
                                    <i class="far fa-trash-alt"></i>  '.__('words.delete').'
                                </a>
                            </div>';
                return $actionBtn;
            })

            ->editColumn('created_at', function ($date) {
                return $date->created_at->format('d-m-Y');
            })
            ->editColumn('order_status', function ($order) {
                $output = '<form id="orderStatus-'.$order->order_code.'" action="'.route('orders.edit', $order->order_code).'" onchange="document.getElementById(\'orderStatus-'.$order->order_code.'\').submit();">';
                $output .= '<select class="form-control" name="orderStatus">';
                $output .= '<option '.(($order->order_status == 0) ? 'selected style="color:white;font-weight:bold;background-color:#051922" ' : '').'value="0">'.__('words.statusProcessing').'</option>';
                $output .= '<option '.(($order->order_status == 1) ? 'selected style="color:white;font-weight:bold;background-color:#051922"' : '').'value="1">'.__('words.statusDelivered').'</option>';
                $output .= '<option '.(($order->order_status == -1) ? 'selected style="color:white;font-weight:bold;background-color:#051922"' : '').'value="-1">'.__('words.statusCanceled').'</option>';
                $output .= '<option '.(($order->order_status == -2) ? 'selected style="color:white;font-weight:bold;background-color:#051922"' : '').'value="-2">'.__('words.statusReturned').'</option>';
                $output .= '</select>';
                $output .= '</form>';
                return $output;
            })
            ->rawColumns(['order_status','action'])
            ->editColumn('total_amount', function ($total) {
                return number_format($total->total_amount, 2, ',', '.'); // Format the total_amount column
            })
            ->make(true);
        }
        return view('backend.orders.order');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request ,string $order_code)
    {
        $idShow = $order_code;
        if($request->ajax())
        {
            $data = Order::where('order_code', $order_code)->where('order_status','0')->get();
            return DataTables::of($data)->addIndexColumn()
            ->editColumn('created_at', function ($date) {
                return $date->created_at->format('d-m-Y');
            })
            ->editColumn('name', function ($name) {
                if(session()->get('lang') == 'ar'){
                    $prodect_name = Prodecut::where('id',$name->product_id)->pluck('nameAr');
                }else{
                    $prodect_name = Prodecut::where('id',$name->product_id)->pluck('nameEn');
                }
                return $prodect_name[0];
            })
            ->editColumn('price', function ($price) {
                $prodect_name = Prodecut::where('id',$price->product_id)->pluck('price');
                return $prodect_name[0];
            })
            ->addColumn('quantity', function ($quantity) {
                $input = "<form action='".route('orders.update', $quantity->id)."' id='quantity-change-form' method='post'>";
                $input .= csrf_field();
                $input .= method_field('PUT');
                $input .= "<input type='hidden' name='quantityOld' value='" . $quantity->quantity . "' style='width: 10px;'>";
                $input .= "<input type='number' name='quantity' min='0' value='" . $quantity->quantity . "' style='width: 80px; padding: 10px; border-radius: 10px;border: 1px solid #eee;'>";
                $input .= "</form>";
                return $input;
            })
            ->editColumn('total', function ($total) {
                $prodect_price = Prodecut::where('id',$total->product_id)->pluck('price');
                return $prodect_price[0] * $total->quantity;
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
            ->rawColumns(['action', 'quantity'])
            ->make(true);
        }
        return view('backend.orders.show',compact('idShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $order_code,Request $request)
    {
        $orders = Order::where('order_code', $order_code)->get();
        foreach ($orders as $order) {
            $order->update([
                'order_status' => $request->orderStatus
            ]);
        }
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgChangeStatusAr'),
                'messageEn' => __('words.msgChangeStatusEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Order = Order::where('id',$id)->first();
        $product = Prodecut::find($Order->product_id);
        $validator = Validator::make($request->all(), [
            'quantity' => 'numeric|min:1|max:'.$product->quantity,
        ]);
        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back();
        }
        if($request->quantity > $request->quantityOld){
            $newQuntity = $request->quantity - $request->quantityOld;
            $product->update([
                'quantity' => $product->quantity - $newQuntity
            ]);
        }elseif($request->quantity < $request->quantityOld){
            $newQuntity = $request->quantityOld - $request->quantity;
            $product->update([
                'quantity' => $product->quantity + $newQuntity
            ]);
        }
        Order::where('id',$id)->update([
            'quantity' => $request->quantity,
            'order_total' => $request->quantity * $product->price,
        ]);
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgChangeQuantityAr'),
                'messageEn' => __('words.msgChangeQuantityEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy(Request $request, string $id)
    {
        $order = Order::find($request->id);
        $prodect = Prodecut::find($order->product_id);
        $prodect->update([
            'quantity' => $prodect->quantity + $order->quantity
        ]);
        $order->delete();
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgDeleteOrderProAr'),
                'messageEn' => __('words.msgDeleteOrderProEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        return redirect()->back();
    }

    public function delete(Request $request, string $id)
    {
        $order = Order::where('order_code',$request->id)->first();
        $prodect = Prodecut::find($order->product_id);
        $prodect->update([
            'quantity' => $prodect->quantity + $order->quantity
        ]);
        $order->delete();
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgDeleteOrderAr'),
                'messageEn' => __('words.msgDeleteOrderEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        return redirect()->back();
    }
}
