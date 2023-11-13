<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductCotroller;
use App\Http\Controllers\Upload;
use App\Models\Cart;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/cart', [CartController::class, 'getData']);
Route::post('/add-cart', [CartController::class, 'addCart']);
Route::get('/cart-data', [CartController::class, 'getDataFromTable']);
Route::delete('/cart-data/{id}', [CartController::class, 'deleteCartItem']);
Route::delete('/delete-cart/{id}', [CartController::class, 'delete']);
Route::put('/update-cart/{id_product}', [CartController::class, 'update']);
Route::get('/all-cart/{user_id}', [CartController::class, 'getDataFromTable']);

Route::get('/product', [ProductCotroller::class,'getData']);
Route::get('/product/{id}', [ProductCotroller::class,'show']);
Route::post('/add-product', [ProductCotroller::class,'add']);
Route::delete('/delete-product/{id}', [ProductCotroller::class,'delete']);
Route::put('/update-product/{id}', [ProductCotroller::class,'update']);


Route::post('/uploadd', [Upload::class, 'index']);
Route::view('upload', 'upload');


Route::post('/checkout', [CartController::class, 'checkout']);
