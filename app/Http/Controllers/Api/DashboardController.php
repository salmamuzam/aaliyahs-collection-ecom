<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Helpers\ResponseHelper;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Get Admin Dashboard Statistics (Complex Aggregations)
     */
    public function index()
    {
        try {
            $stats = [
                'revenue' => [
                    'total_paid' => (float) Order::where('payment_status', 'paid')->sum('grand_total'),
                    'pending_amount' => (float) Order::where('payment_status', 'pending')->sum('grand_total'),
                    'currency' => 'LKR'
                ],
                'counts' => [
                    'total_orders' => Order::count(),
                    'total_products' => Product::count(),
                    'total_categories' => Category::count(),
                    'total_customers' => User::where('user_type', 'user')->count(),
                ],
                'order_status_breakdown' => Order::select('status', DB::raw('count(*) as count'))
                    ->groupBy('status')
                    ->get(),
                'recent_sales' => Order::with('user')
                    ->where('payment_status', 'paid')
                    ->latest()
                    ->take(5)
                    ->get()
                    ->map(fn($order) => [
                        'id' => $order->id,
                        'customer' => $order->user->first_name . ' ' . $order->user->last_name,
                        'amount' => $order->grand_total,
                        'date' => $order->created_at->diffForHumans()
                    ]),
                'category_distribution' => Category::withCount('products')->get()->map(fn($cat) => [
                    'name' => $cat->name,
                    'count' => $cat->products_count
                ])
            ];

            return ResponseHelper::success(
                message: 'Dashboard statistics fetched successfully!',
                data: $stats
            );
        } catch (Exception $e) {
            Log::error('Dashboard API Error: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to fetch dashboard data!', statusCode: 500);
        }
    }
}
