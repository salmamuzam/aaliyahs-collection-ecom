<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Resources\OrderResource;
use App\Http\Requests\UpdateOrderStatusRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Events\OrderStatusUpdated;

/**
 * Controller for Admin Order Management
 */
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $orders = Order::with('user', 'items.product', 'address')
                ->when($request->search, function ($query, $search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('id', 'like', "%{$search}%")
                            ->orWhereHas('user', fn($u) => $u->where('first_name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%"));
                    });
                })
                ->when($request->status, fn($q, $status) => $q->where('status', $status))
                ->latest()
                ->paginate(10);

            return ResponseHelper::success(
                message: 'Orders fetched successfully!',
                data: OrderResource::collection($orders)
            );
        } catch (Exception $e) {
            Log::error('Unable to fetch orders: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to fetch orders!', statusCode: 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        try {
            return ResponseHelper::success(
                message: 'Order details fetched successfully!',
                data: new OrderResource($order->load('user', 'items.product', 'address'))
            );
        } catch (Exception $e) {
            Log::error('Unable to fetch order: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to fetch order!', statusCode: 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderStatusRequest $request, Order $order)
    {
        try {
            $order->update($request->validated());

            if ($order->wasChanged('status')) {
                OrderStatusUpdated::dispatch($order->load('user', 'items.product'));
            }

            return ResponseHelper::success(
                message: 'Order status updated successfully!',
                data: new OrderResource($order)
            );
        } catch (Exception $e) {
            Log::error('Unable to update order: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to update order!', statusCode: 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        try {
            $order->delete();
            return ResponseHelper::success(message: 'Order deleted successfully!');
        } catch (Exception $e) {
            Log::error('Unable to delete order: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to delete order!', statusCode: 500);
        }
    }
}
