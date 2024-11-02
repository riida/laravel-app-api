<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class CreateProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
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
