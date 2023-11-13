<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function getData(){
        return Cart::all();
    }

    public function getDataFromTable(Request $request, $userId){
        $result = Cart::join('products', 'carts.id_product', '=', 'products.id')
            ->where('carts.user_id', $userId)
            ->select('carts.*', 'products.*')
            ->get();
    
        return response()->json($result);
    }

    function deleteCartItem(Request $request, $product_id){
    $cartItem = Cart::where('id_product', $product_id);

    if (!$cartItem) {
        return response()->json(['message' => 'Mục giỏ hàng không tồn tại.'], 404);
    }

    $cartItem->delete();

    return response()->json(['message' => 'Xóa mục giỏ hàng thành công']);
}

    
    
public function addCart(Request $request)
{
    $user_id = $request->user_id;
    $id_product = $request->id_product;
    $number = $request->number;

    
    $existingCart = Cart::where('user_id', $user_id)
        ->where('id_product', $id_product)
        ->first();

    if ($existingCart) {
        
        $existingCart->number += $number;
        $existingCart->save();
    } else {
       
        $cart = new Cart;
        $cart->user_id = $user_id;
        $cart->id_product = $id_product;
        $cart->number = $number;
        $cart->save();
    }

    return response()->json(['message' => 'Thêm vào giỏ hàng thành công']);
}

    function delete($id){
        $cart = Cart::find($id);
        $cart->delete();
    }

    public function update(Request $request){
      
        $affectedRows = Cart::where('id_product', $request->id_product)
                            ->update(['number' => $request->number]);
        if ($affectedRows > 0) {
            return response()->json(['message' => 'Cart item updated successfully']);
        } else {
            return response()->json(['error' => 'Cart item not found'], 404);
        }
    }
    
    
    

    public function checkout()
    {
        try {
            $cartItems = Cart::all();
            Cart::truncate();
            $products = [];
            foreach ($cartItems as $cartItem) {
                $product = Products::find($cartItem->id_product);
                if ($product) {
                    $product->update([
                        'so_luong' => $product->so_luong - $cartItem->number
                    ]);

                    $products[] = [
                        'name' => $product->name_product,
                        'quantity' => $cartItem->number,
                        'price' => $product->gia,
                    ];
                } else {
           
                }
            }
         
            foreach ($cartItems as $cartItem) {
                $user = User::find($cartItem->user_id);
                if ($user) {
                    $userEmail = $user->email;
                    Mail::to($userEmail)->send(new OrderShipped($products));
                   
            return response()->json(['message' => 'Đặt hàng thành công']);
                } else {
           
                }
            }

            
        } catch (\Exception $e) {
        
            return response()->json(['message' => 'Có lỗi xảy ra trong quá trình thanh toán. Vui lòng thử lại sau.'], 500);
        }
    }
}

    


