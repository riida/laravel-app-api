<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', UserController::class)->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', ProductController::class);
});
