<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;

// Auth Routes

Route::controller(AuthController::class)->group(function (){
    Route::post('/register', 'register');
    Route::post('/login', 'login');

    // Check whether user is logged in or not
    Route::get('user', 'userProfile')->middleware('auth:sanctum');
    Route::get('logout', 'logout')->middleware('auth:sanctum');
});

// Admin CRUD Routes

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::apiResource('/categories', CategoryController::class);
});

