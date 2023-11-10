<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    // API User


});
Route::post('/users/register', [UserController::class, 'register']);
Route::put('/users/edit{id}', [UserController::class, 'editUser']);
Route::delete('/users/delete{id}', [UserController::class, 'deleteUser']);
Route::get('/users/{id}', [UserController::class, 'getUser']);

// API User_detail với middleware
Route::get('/user/{userId}/detail', [UserDetailController::class, 'getUserDetail']);
Route::post('/user/{userId}/detail', [UserDetailController::class, 'addUserDetail']);
Route::put('/user/{userId}/detail', [UserDetailController::class, 'editUserDetail']);
Route::delete('/user/{userId}/detail', [UserDetailController::class, 'deleteUserDetail']);
