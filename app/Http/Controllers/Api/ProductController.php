<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductApiResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //domain.com/api/services?
    public function index(Request $request)
    {
        $productServices = Product::with(['category']);

        if ($request->has('category_id')) {
            $productServices->where('category_id', $request->input('category_id'));
        }

        if ($request->has('is_popular')) {
            $productServices->where('is_popular', $request->input('is_popular'));
        }

        if ($request->has('limit')) {
            $productServices->limit($request->input('limit'));
        }

        return ProductApiResource::collection($productServices->get());
    }

    //MODEL BINDING LARAVEL
    //not found 404 klo ga ada
    public function show(Product $productService)
    {
        //EAGER LOAD TO HANDLE N+1 QUERY PROBLEM
        $productService->load('category', 'benefits', 'testimonials');

        return new ProductApiResource($productService);
    }
}
