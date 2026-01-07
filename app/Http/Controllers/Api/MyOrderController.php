<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Resources\OrderResource;
use App\Http\Requests\OrderRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;

/**
 * Controller for Customer/User Orders (My Orders & Checkout)
 */
class MyOrderController extends Controller
{
    /**
     * Display a listing of personal orders.
     */
    public function index(Request $request)
    {
        try {
            $orders = Order::with('user', 'items.product', 'address')
                ->where('user_id', auth()->id())
                ->when($request->search, function ($query, $search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('id', 'like', "%{$search}%")
                            ->orWhere('status', 'like', "%{$search}%")
                            ->orWhere('payment_status', 'like', "%{$search}%")
                            ->orWhereHas('items.product', fn($pq) => $pq->where('name', 'like', "%{$search}%"));
                    });
                })
                ->latest()
                ->paginate(10);

            return ResponseHelper::success(
                message: 'My orders fetched successfully!',
                data: OrderResource::collection($orders)
            );
        } catch (Exception $e) {
            Log::error('Unable to fetch my orders: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to fetch orders!', statusCode: 500);
        }
    }

    /**
     * Place a new Order (Checkout).
     */
    public function store(OrderRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $validated = $request->validated();
                $grandTotal = 0;
                $orderItemsData = [];

                foreach ($validated['items'] as $item) {
                    $product = Product::findOrFail($item['product_id']);
                    $totalAmount = $product->price * $item['quantity'];
                    $grandTotal += $totalAmount;

                    $orderItemsData[] = [
                        'product_id' => $product->id,
                        'quantity' => $item['quantity'],
                        'unit_amount' => $product->price,
                        'total_amount' => $totalAmount
                    ];
                }

                $order = Order::create([
                    'user_id' => auth()->id(),
                    'grand_total' => $grandTotal,
                    'payment_method' => $validated['payment_method'],
                    'payment_status' => 'pending',
                    'status' => 'new',
                    'currency' => 'lkr',
                    'notes' => 'Order placed via API'
                ]);

                $order->items()->createMany($orderItemsData);
                $order->address()->create(array_merge($validated, ['user_id' => auth()->id(), 'country' => 'Sri Lanka']));

                // Send Email fluently
                rescue(fn() => Mail::to($request->user())->send(new OrderPlaced($order)), function ($e) {
                    Log::error('Order Email Failed: ' . $e->getMessage());
                });

                return ResponseHelper::success(
                    message: 'Order placed successfully!',
                    data: new OrderResource($order->load('items.product', 'address')),
                    statusCode: 201
                );
            });
        } catch (Exception $e) {
            Log::error('Unable to place order: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to place order!', statusCode: 500);
        }
    }

    /**
     * Show single personal order.
     */
    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            return ResponseHelper::error(message: 'Unauthorized', statusCode: 403);
        }

        return ResponseHelper::success(
            message: 'Order details fetched successfully!',
            data: new OrderResource($order->load('user', 'items.product', 'address'))
        );
    }
}
