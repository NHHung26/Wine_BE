<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductCotroller extends Controller
{
    function getData(){
        $products =  Products::all();
        return response()->json($products)
        ->header('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
    }

    public function show($id)
    {
        $product = Products::find($id);
        return response()->json($product)
        ->header('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
    }
    
    function add(Request $request){
        
        $path = $request->file('file')->store('public');
        $url = asset(str_replace('public', 'storage', $path));
        $product = new Products;
        $product->name_product = $request->name_product;
        $product->the_tich = $request->the_tich;
        $product->gia = $request->gia;
        $product->so_luong = $request->so_luong;
        $product->image = $url;
        $product->nong_do = $request->nong_do;
        $product->nsx = $request->nsx;
        $product->mo_ta = $request->mo_ta;
        $product->save();
    }

    function delete($id){
        $product = Products::find($id);
        $product->delete();
    }

    function update(Request $request){
        $product = Products::find($request->id);
        $product->name_product = $request->name_product;
        $product->the_tich = $request->the_tich;
        $product->gia = $request->gia;
        $product->so_luong = $request->so_luong;
        $product->image = $request->image;
        $product->nong_do = $request->nong_do;
        $product->nsx = $request->nsx;
        $product->mo_ta = $request->mo_ta;
        $product->save();
    }
}
