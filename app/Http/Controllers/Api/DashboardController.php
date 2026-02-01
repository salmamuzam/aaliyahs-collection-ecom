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
            // Utilizing the Stored Procedure (Advanced SQL Feature)
            $highValueCustomers = [];
            try {
                $highValueCustomers = DB::select('CALL GetHighValueCustomers(?)', [10000]);
            } catch (Exception $e) {
                Log::warning('Stored procedure GetHighValueCustomers failed or missing: ' . $e->getMessage());
            }

            // Innovation: Use withoutGlobalScopes() to prevent "only_full_group_by" SQL errors
            $stats = [
                'revenue' => [
                    'total_paid' => (float) Order::withoutGlobalScopes()->where('payment_status', '=', 'paid')->sum('grand_total'),
                    'pending_amount' => (float) Order::withoutGlobalScopes()->where('payment_status', '=', 'pending')->sum('grand_total'),
                    'avg_order_value' => (float) (Order::withoutGlobalScopes()->where('payment_status', '=', 'paid')->avg('grand_total') ?? 0),
                    'currency' => 'LKR'
                ],
                'counts' => [
                    'total_orders' => (int) Order::withoutGlobalScopes()->count(),
                    'total_products' => (int) Product::count(),
                    'total_categories' => (int) Category::count(),
                    'total_customers' => (int) User::where('user_type', '=', 'customer')->count(),
                ],
                'order_status_breakdown' => Order::withoutGlobalScopes()
                    ->select('status', DB::raw('COUNT(*) as count'))
                    ->groupBy('status')
                    ->get(),
                'sales_trend' => Order::withoutGlobalScopes()
                    ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(grand_total) as total'))
                    ->where('payment_status', '=', 'paid')
                    ->where('created_at', '>=', now()->subDays(30))
                    ->groupBy('date')
                    ->get(),
                'top_selling_products' => DB::table('order_items')
                    ->join('products', 'order_items.product_id', '=', 'products.id')
                    ->select('products.name', DB::raw('SUM(order_items.quantity) as total_quantity'), DB::raw('SUM(order_items.total_amount) as total_revenue'))
                    ->groupBy('products.id', 'products.name')
                    ->orderByDesc('total_revenue')
                    ->take(5)
                    ->get(),
                'high_value_customers' => $highValueCustomers
            ];

            return ResponseHelper::success(
                message: 'Dashboard statistics fetched successfully!',
                data: $stats
            );
        } catch (Exception $e) {
            Log::error('Dashboard API Error: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to fetch dashboard data! ' . $e->getMessage(), statusCode: 500);
        }
    }
}
