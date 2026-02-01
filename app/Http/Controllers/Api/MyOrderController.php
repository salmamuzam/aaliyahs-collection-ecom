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

                // Filter address data (remove payment_method and items from the address save)
                $addressData = $request->only([
                    'first_name',
                    'last_name',
                    'email',
                    'phone',
                    'street_address',
                    'city',
                    'province',
                    'postal_code'
                ]);

                $order->address()->create(array_merge($addressData, [
                    'user_id' => auth()->id(),
                    'country' => 'Sri Lanka'
                ]));

                // Logic for Payment Redirection (Stripe API)
                $paymentUrl = null;
                if ($validated['payment_method'] === 'stripe') {
                    try {
                        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                        $session = \Stripe\Checkout\Session::create([
                            'payment_method_types' => ['card'],
                            'customer_email' => $request->user()->email,
                            'line_items' => [
                                [
                                    'price_data' => [
                                        'currency' => 'lkr',
                                        'product_data' => ['name' => 'Order #' . $order->id],
                                        'unit_amount' => (int) ($grandTotal * 100),
                                    ],
                                    'quantity' => 1,
                                ]
                            ],
                            'mode' => 'payment',
                            'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}&order_id=' . $order->id,
                            'cancel_url' => route('payment.cancel'),
                        ]);
                        $paymentUrl = $session->url;
                    } catch (\Exception $e) {
                        Log::error("Stripe API Error: " . $e->getMessage());
                    }
                }

                // Fire Event for background processing
                \App\Events\OrderPlaced::dispatch($order);

                return ResponseHelper::success(
                    message: 'Order placed successfully!',
                    data: [
                        'order' => new OrderResource($order->load('items.product', 'address')),
                        'payment_url' => $paymentUrl // Flutter can open this in WebView
                    ],
                    statusCode: 201
                );
            });
        } catch (Exception $e) {
            Log::error('Unable to place order: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to place order! ' . $e->getMessage(), statusCode: 500);
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
