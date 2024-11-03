<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthInfoController;
use App\Http\Controllers\Api\AuthLoginController;
use App\Http\Controllers\Api\CreateProductController;
use App\Http\Controllers\Api\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', AuthLoginController::class)->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/info', AuthInfoController::class);

    Route::post('/product', CreateProductController::class);
    Route::get('/products', ProductController::class);
});
