<?php

namespace App\Http\Controllers;

use App\Models\Cart;

use Illuminate\Http\Request;

class CartController extends Controller
{
    function getData(){
        return Cart::all();
    }
    
    function addCart(Request $request){
        $cart = new Cart;
        $cart->user_id = $request->user_id;
        $cart->id_product = $request->id_product;
        $cart->so_luong = $request->so_luong;
        $cart->tong_tien = $request->tong_tien;
        $cart->save();
    }

    function delete($id){
        $cart = Cart::find($id);
        $cart->delete();
    }

    function update(Request $request){
        $cart = Cart::find($request->id);
        $cart->id_product = $request->id_product;
        $cart->so_luong = $request->so_luong;
        $cart->tong_tien = $request->tong_tien;
        $cart->save();
    }

}
