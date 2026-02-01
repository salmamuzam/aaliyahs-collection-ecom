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
            // 1. Base Query with relationships & aggregates
            $query = Product::with('category')
                ->withCount('reviews')
                ->withAvg('reviews', 'rating');

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

            // 3. Price Range (Min/Max)
            if ($request->has('min_price')) {
                $query->where('price', '>=', $request->min_price);
            }
            if ($request->has('max_price')) {
                $query->where('price', '<=', $request->max_price);
            }
            // Backward compatibility for 'price_range'
            if ($request->has('price_range') && !$request->has('max_price')) {
                $query->where('price', '<=', $request->price_range);
            }

            // 4. Sorting
            $sort = $request->input('sort', 'latest');
            switch ($sort) {
                case 'price_asc':
                case 'low_to_high':
                case 'low-to-high':
                case 'price':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                case 'high_to_low':
                case 'high-to-low':
                    $query->orderBy('price', 'desc');
                    break;
                case 'oldest':
                    $query->oldest();
                    break;
                case 'latest':
                default:
                    $query->latest();
                    break;
            }

            // Pagination (Matches ShopPage: 6 items)
            $products = $query->paginate($request->input('per_page', 6));

            return ResponseHelper::success(
                message: 'Shop products fetched successfully!',
                data: ProductResource::collection($products)->response()->getData(true),
                statusCode: 200
            );

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
            $product = Product::with('category')
                ->withCount('reviews')
                ->withAvg('reviews', 'rating')
                ->findOrFail($id);

            return ResponseHelper::success(message: 'Product details fetched successfully!', data: new ProductResource($product), statusCode: 200);

        } catch (Exception $e) {
            Log::error('Unable to fetch product: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to fetch product! Please try again!', statusCode: 500);
        }
    }

    /**
     * Shop Metadata - Get Prices and Categories for Filters (Innovative Flutter Aid)
     */
    public function filters()
    {
        try {
            $data = [
                'price_range' => [
                    'min' => (float) Product::min('price') ?? 0,
                    'max' => (float) Product::max('price') ?? 0,
                ],
                'categories' => \App\Http\Resources\CategoryResource::collection(\App\Models\Category::all())
            ];

            return ResponseHelper::success(message: 'Filter metadata fetched!', data: $data);
        } catch (Exception $e) {
            Log::error('Shop Filters Error: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Error fetching filters', statusCode: 500);
        }
    }
}
