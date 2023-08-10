<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Good;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addCart(Request $request){
        $productId = $request->productId;
        $quantity = $request->quantity;
        $userId = auth()->user()->id;
        $status = 1;
        $cart = new Cart();
        $cart->product_id = $productId;
        $cart->quantity = $quantity;
        $cart->user_id = $userId;
        $cart->status = $status;
        $cart->save();
        return redirect()->intended('/cart');
    }

    public function showCart(){
        $userId = auth()->user()->id;
        $carts = Cart::where('user_id', $userId)->get();
        foreach ($carts as $cart){
            $productId = $cart->product_id;
            $product = Good::where('id', $productId)->first();
            $cart->title = $product->title;
            $cart->cost = $product->cost;
            $cart->img = $product->img;
        }
        return view('pages.cart', ['carts'=>$carts]);
    }
    public function deleteCart(Request $request){
        $cartId = $request->cartId;
        $cart = Cart::where('id', $cartId)->first();
        $cart->delete();
        return redirect()->intended('/cart');
    }
    public function changeQuantity(Request $request){
        $quantity = $request->quantity;
        $id = $request->id;
        $cart = Cart::where('id', $id)->first();
        $cart->quantity = $quantity;
        $cart->save();
        return json_encode(['result'=>'success']);
    }
}
