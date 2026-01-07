<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Resources\ProductResource;
use Exception;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    /**
     * Shop Page - List Products with Filtering
     */
    public function index(Request $request)
    {
        try {
            // REMOVED 'in_stock' check as column does not exist
            $query = Product::with('category');

            // 1. Search (Name/Description)
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            }

            // 2. Selected Categories (Array or Comma-separated)
            if ($request->has('selected_categories')) {
                $cats = is_array($request->selected_categories)
                    ? $request->selected_categories
                    : explode(',', $request->selected_categories);

                if (!empty($cats)) {
                    $query->whereIn('category_id', $cats);
                }
            }

            // 3. Price Range (Max Price)
            if ($request->has('price_range')) {
                $query->whereBetween('price', [0, $request->price_range]);
            }

            // 4. Sorting
            if ($request->has('sort')) {
                if ($request->sort == 'latest') {
                    $query->latest();
                } elseif ($request->sort == 'price') {
                    $query->orderBy('price');
                }
            } else {
                // Default sort
                $query->latest();
            }

            // Pagination (Matches ShopPage: 6 items)
            $products = $query->paginate(6);

            return ResponseHelper::success(message: 'Shop products fetched successfully!', data: ProductResource::collection($products), statusCode: 200);

        } catch (Exception $e) {
            Log::error('Shop Index Error: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to fetch shop products! Please try again!', statusCode: 500);
        }
    }

    /**
     * Product Detail Page - Show Single Product
     */
    public function show($id)
    {
        try {
            // REMOVED 'brand' relationship as it does not exist
            $product = Product::with('category')->findOrFail($id);

            return ResponseHelper::success(message: 'Product details fetched successfully!', data: new ProductResource($product), statusCode: 200);

        } catch (Exception $e) {
            Log::error('Unable to fetch product: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to fetch product! Please try again!', statusCode: 500);
        }
    }
}
