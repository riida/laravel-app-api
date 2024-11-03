<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class CreateProductController extends Controller
{
    public function __invoke(CreateProductRequest $request)
    {
        $product = new Product();
        $product->fill($request->validated());
        $product->save();
        ProductResource::withoutWrapping();
        return (new ProductResource($product))->response();
    }
}
