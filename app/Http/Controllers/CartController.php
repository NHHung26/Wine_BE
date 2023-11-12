<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;

class CartController extends Controller
{
    function getData(){
        return Cart::all();
    }

    function getDataFromTable(Request $request){
        $result = Cart::join('products', 'carts.id_product', '=', 'products.id')
            ->select('carts.*', 'products.*',)
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

    
    
function addCart(Request $request) {
    $cart = new Cart;
    $cart->user_id = $request->user_id;
    $cart->id_product = $request->id_product;
    $cart->number = $request->number;
    $cart->save();
}

    function delete($id){
        $cart = Cart::find($id);
        $cart->delete();
    }

    public function update(Request $request){
        // Cập nhật số lượng (number) trong bảng carts dựa trên id_product
        $affectedRows = Cart::where('id_product', $request->id_product)
                            ->update(['number' => $request->number]);
    
        // Kiểm tra xem có bản ghi nào được cập nhật không
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
                    // Handle the case where a product is not found
           
                }
            }

            $userEmail = 'huyhungbodoi123@gmail.com';
            Mail::to($userEmail)->send(new OrderShipped($products));

            

            return response()->json(['message' => 'Đặt hàng thành công']);
        } catch (\Exception $e) {
            

            // Log the full exception details for debugging
           

            return response()->json(['message' => 'Có lỗi xảy ra trong quá trình thanh toán. Vui lòng thử lại sau.'], 500);
        }
    }
}

    


