<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductCotroller;
use App\Http\Controllers\Upload;
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

Route::get('/cart', [CartController::class,'getData']);
Route::post('/add-cart', [CartController::class,'addCart']);
Route::delete('/delete-cart/{id}', [CartController::class,'delete']);
Route::put('/update-cart/{id}', [CartController::class,'update']);

Route::get('/product', [ProductCotroller::class,'getData']);
Route::post('/add-product', [ProductCotroller::class,'add']);
Route::delete('/delete-product/{id}', [ProductCotroller::class,'delete']);
Route::put('/update-product/{id}', [ProductCotroller::class,'update']);


Route::post('/uploadd',[Upload::class, 'index']);
Route::view('upload','upload');