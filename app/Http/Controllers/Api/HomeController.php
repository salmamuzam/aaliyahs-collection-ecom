<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Resources\CategoryResource;
use Exception;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Home Page Data
     */
    public function index()
    {
        try {
            $data = \Illuminate\Support\Facades\Cache::remember('api_home_data_strict_v1', 3600, function () {
                return [
                    'categories' => CategoryResource::collection(Category::with('products:id,category_id')->get()),
                    'latest_products' => \App\Http\Resources\ProductResource::collection(
                        \App\Models\Product::with('category.products:id,category_id')->latest()->take(8)->get()
                    ),
                    'featured_products' => \App\Http\Resources\ProductResource::collection(
                        \App\Models\Product::with('category.products:id,category_id')->inRandomOrder()->take(4)->get()
                    ),
                    'best_sellers' => \App\Http\Resources\ProductResource::collection(
                        \App\Models\Product::with('category')
                            ->withCount([
                                'orderItems as total_sold' => function ($query) {
                                    $query->select(\Illuminate\Support\Facades\DB::raw('sum(quantity)'));
                                }
                            ])
                            ->orderByDesc('total_sold')
                            ->take(6)
                            ->get()
                    ),
                ];
            });

            return ResponseHelper::success(message: 'Home data fetched successfully!', data: $data, statusCode: 200);

        } catch (Exception $e) {
            Log::error('Home Index Error: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to fetch home data! Please try again!', statusCode: 500);
        }
    }
}
