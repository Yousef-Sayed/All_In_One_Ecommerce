<?php

namespace App\Http\Controllers;

// use Cart;
// use Darryldecode\Cart\Cart;
// use Cart instead of use Darryldecode\Cart\Cart;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\backend\Order;
use App\Models\backend\Prodecut;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index(){
        if(session()->has('cart')){
            if (count(session()->get('cart')) != 0) {
                return view('frontend.cart');
            }else{
                return redirect()->route('homePage');
            }
        }else{
            return redirect()->route('homePage');
        }
    }
    public function add($id){
        $Product = Prodecut::find($id);
        $userid  = Auth::user()->id;
        $cart = session()->get('cart',[]);
        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
        }else{
            $cart[$id] = [
                'userID'=> $userid,
                'id' => $id,
                'nameAr' => $Product->nameAr,
                'nameEn' => $Product->nameEn,
                'quantity' => 1,
                'price' => $Product->price,
                'image' => $Product->image
            ];
        }
        session()->put('cart',$cart);
        session()->put('addcart',__('words.msgAddCart'));
        return redirect()->back();
    }

    public function update(Request $request){
        $cart = session()->get('cart');
        $quantity = Prodecut::find($request->rowid);
        $validator = Validator::make($request->all(), [
            'quantity' => 'numeric|min:1|max:'.$quantity->quantity,
        ]);
        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back();
        }
        if(isset($cart[$request->rowid])){
            $cart[$request->rowid]['quantity'] = $request->quantity;
        }
        session()->put('cart', $cart);
        return redirect()->back();
    }
    public function reomve($id){
        if (session()->has('cart')) {
            $cart = session()->get('cart');
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        if (count(session()->get('cart')) != 0) {
            return redirect()->back();
        }else{
            return redirect()->route('homePage');
        }
    }

    public function checkout(){
        return view('frontend.checkout');
    }

     public function updateContent(Request $request, $id)
    {
        $content = $id;
        return response()->json(['content' => $content]);
    }
    public function crateOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:40',
            'shippingValue' => 'required',
            'address' => 'required|string|min:10|max:255',
            'phone' => 'required|string|min:11|max:15',
            'note' => 'string|min:20|max:255|nullable',
        ]);
        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back();
        }
        $order_code = Str::random(10);
        foreach(session()->get('cart') as $cart){
            $prodect = Prodecut::where('id',$cart['id'])->first();
            $prodect->update([
                'quantity' => $prodect->quantity - $cart['quantity']
            ]);
            Order::create([
                'user_id' => $cart['userID'],
                'shipping_name' => $request->name,
                'shipping_address' => $request->address,
                'phone' => $request->phone,
                'product_id' => $cart['id'],
                'prodect_price' => $cart['price'],
                'quantity' => $cart['quantity'],
                'order_total' => $cart['price'] * $cart['quantity'],
                'shipping_value' => $request->shippingValue,
                'order_code' => 'AIO-'.$order_code,
            ]);
            if(! is_null($request->note)){
                Order::create([
                    'note' => $request->note,
                ]);
            }
        }
        session()->forget('cart');
        return redirect()->route('homePage');
    }
}

