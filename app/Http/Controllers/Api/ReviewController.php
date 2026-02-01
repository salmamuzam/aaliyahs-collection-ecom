<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ReviewController extends Controller
{
    /**
     * Display a listing of reviews for a specific product.
     */
    public function index($productId)
    {
        try {
            $page = request()->get('page', 1);
            $cacheKey = "product_{$productId}_reviews_page_{$page}";

            $reviews = Cache::remember($cacheKey, 600, function () use ($productId) {
                return Review::with('user')
                    ->where('product_id', $productId)
                    ->latest()
                    ->paginate(10);
            });

            return ResponseHelper::success(
                message: 'Reviews fetched successfully!',
                data: ReviewResource::collection($reviews)->response()->getData(true)
            );
        } catch (Exception $e) {
            Log::error('Review Fetch Error: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to fetch reviews!', statusCode: 500);
        }
    }

    /**
     * Store a newly created review in storage (Protected).
     */
    public function store(ReviewRequest $request)
    {
        try {
            $userId = Auth::id();
            $productId = $request->product_id;

            // 1. Check if user already reviewed this product
            $existingReview = Review::where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if ($existingReview) {
                return ResponseHelper::error(message: 'You have already reviewed this product.', statusCode: 400);
            }

            // 2. Verified Buyer Check (Crucial for e-commerce)
            $isVerified = Order::where('user_id', $userId)
                ->whereHas('items', function ($query) use ($productId) {
                    $query->where('product_id', $productId);
                })->exists();

            if (!$isVerified) {
                return ResponseHelper::error(message: 'Purchase required to review this product.', statusCode: 403);
            }

            $review = Review::create([
                'product_id' => $productId,
                'user_id' => $userId,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'is_verified' => $isVerified,
            ]);

            // Invalidate Caches
            Cache::forget("product_{$productId}_stats");
            Cache::flush(); // Simple flush to ensure fresh data across lists

            return ResponseHelper::success(
                message: 'Review submitted successfully!',
                data: new ReviewResource($review->load('user')),
                statusCode: 201
            );
        } catch (Exception $e) {
            Log::error('Review Submission Error: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to submit review!', statusCode: 500);
        }
    }

    /**
     * Get product rating stats (Detailed breakdown)
     */
    public function stats($productId)
    {
        try {
            $stats = Cache::remember("product_{$productId}_stats", 3600, function () use ($productId) {
                $allReviews = Review::where('product_id', $productId)->get();
                $total = $allReviews->count();

                if ($total == 0) {
                    return [
                        'average' => 0,
                        'total' => 0,
                        'distribution' => [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0],
                        'percentages' => [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0]
                    ];
                }

                $average = $allReviews->avg('rating');
                $distribution = $allReviews->groupBy('rating')->map(fn($group) => $group->count());

                $percentages = [];
                for ($i = 5; $i >= 1; $i--) {
                    $count = $distribution->get($i, 0);
                    $percentages[$i] = round(($count / $total) * 100);
                }

                return [
                    'average' => round($average, 1),
                    'total' => $total,
                    'distribution' => [
                        5 => $distribution->get(5, 0),
                        4 => $distribution->get(4, 0),
                        3 => $distribution->get(3, 0),
                        2 => $distribution->get(2, 0),
                        1 => $distribution->get(1, 0),
                    ],
                    'percentages' => $percentages
                ];
            });

            return ResponseHelper::success(message: 'Rating stats fetched!', data: $stats);
        } catch (Exception $e) {
            Log::error('Stats Error: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to fetch stats!', statusCode: 500);
        }
    }
}
