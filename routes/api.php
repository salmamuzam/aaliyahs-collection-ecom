<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
//use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrdersController;


// Public Routes

Route::controller(AuthController::class)->group(function (){
    Route::post('/register', 'register');
    Route::post('/login', 'login');

    // Check whether user is logged in or not
    Route::get('user', 'userProfile')->middleware('auth:sanctum');
    Route::get('logout', 'logout')->middleware('auth:sanctum');
});

// Protected Routes

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::apiResource('/categories', CategoriesController::class);
    Route::resource('/products', ProductsController::class);
    Route::resource('/orders', OrdersController::class);
});
