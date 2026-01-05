<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Requests\ProductRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
        $products = Product::with('category')->paginate(5);
          if ($products) {
                return ResponseHelper::success(message: 'Products fetched successfully!', data: ProductResource::collection($products), statusCode: 200);
            }
            return ResponseHelper::error(message: 'Unable to fetch products! Please try again!', statusCode: 500);
        } catch (Exception $e) {
            Log::error('Unable to fetch products: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to fetch products! Please try again!', statusCode: 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try{
            $product = Product::create($request->validated());
            $product->load('category');
            if ($product) {
                return ResponseHelper::success(message: 'Product created successfully!', data: new ProductResource($product), statusCode: 201);
            }
            return ResponseHelper::error(message: 'Unable to create product! Please try again!', statusCode: 500);
        } catch (Exception $e) {
            Log::error('Unable to create product: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to create product! Please try again!', statusCode: 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
