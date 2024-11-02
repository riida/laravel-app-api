<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Models\Product;

class CreateProductController extends Controller
{
    public function __invoke(CreateProductRequest $request)
    {
        $product = new Product();
        $product->fill($request->validated());
        $product->save();
        return response()->json([
            'product' => $product
        ]);
    }
}
