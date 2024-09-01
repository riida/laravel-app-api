<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

Route::get('/', function () {
    return view('welcome');
});

// Route::post('/mylogin', [MemberController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', ProductController::class);
});
