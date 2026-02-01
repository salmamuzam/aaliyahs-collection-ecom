<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Home Page Data (Optimized & Robust)
     */
    public function index()
    {
        try {
            // Using a specific cache key for the new robust implementation
            $data = Cache::remember('api_home_data_robust_v2', 3600, function () {
                return [
                    'categories' => CategoryResource::collection(
                        Category::withCount('products')->get()
                    ),
                    'latest_products' => ProductResource::collection(
                        Product::withCount('reviews')
                            ->withAvg('reviews', 'rating')
                            ->latest()
                            ->take(8)
                            ->get()
                    ),
                    'featured_products' => ProductResource::collection(
                        Product::withCount('reviews')
                            ->withAvg('reviews', 'rating')
                            ->inRandomOrder()
                            ->take(4)
                            ->get()
                    ),
                    'best_sellers' => ProductResource::collection(
                        Product::withSum('orderItems as total_sold', 'quantity')
                            ->withCount('reviews')
                            ->withAvg('reviews', 'rating')
                            ->orderByDesc('total_sold')
                            ->take(6)
                            ->get()
                    ),
                ];
            });

            return ResponseHelper::success(
                message: 'Home data fetched successfully!',
                data: $data
            );

        } catch (Exception $e) {
            Log::error('Home Index Error: ' . $e->getMessage());
            // Return full error message to user for easier debugging
            return ResponseHelper::error(
                message: 'Unable to fetch home data! ' . $e->getMessage(),
                statusCode: 500
            );
        }
    }
}
