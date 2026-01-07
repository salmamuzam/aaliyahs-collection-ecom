<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Resources\ProductResource;
use App\Http\Requests\WishlistFetchRequest;
use Exception;
use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{
    /**
     * Fetch Wishlist Products (Helper for Client-side Wishlists).
     */
    public function index(WishlistFetchRequest $request)
    {
        try {
            // Validation handled by FormRequest

            $products = Product::whereIn('id', $request->product_ids)->get();

            return ResponseHelper::success(message: 'Wishlist products fetched successfully!', data: ProductResource::collection($products), statusCode: 200);

        } catch (Exception $e) {
            Log::error('Wishlist Fetch Error: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to fetch wishlist! Please try again!', statusCode: 500);
        }
    }
}
