<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Helpers\ResponseHelper;
use App\Http\Requests\CartCalculationRequest;
use Exception;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Calculate Cart Totals (Highly Efficient)
     */
    public function calculate(CartCalculationRequest $request)
    {
        try {
            $productIds = collect($request->items)->pluck('product_id')->filter()->unique()->toArray();
            $products = Product::whereIn('id', (array) $productIds)->get()->keyBy('id');

            $items = collect($request->items)->map(function ($item) use ($products) {
                $product = $products->get($item['product_id']);

                if (!$product || !isset($item['quantity']) || !is_numeric($item['quantity']) || $item['quantity'] <= 0) {
                    return null;
                }

                $quantity = (int) $item['quantity'];

                return [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => (float) $product->price,
                    'quantity' => $quantity,
                    'line_total' => (float) ($product->price * $quantity),
                    'image' => (isset($product->images[0])) ? asset('storage/' . $product->images[0]) : null,
                ];
            })->filter()->values();

            $subtotal = $items->sum('line_total');
            $shipping = 0; // Standard e-commerce logic (free shipping for now)
            $grandTotal = $subtotal + $shipping;

            return ResponseHelper::success(
                message: 'Cart calculated successfully!',
                data: [
                    'items' => $items,
                    'subtotal' => (float) $subtotal,
                    'shipping' => (float) $shipping,
                    'grand_total' => (float) $grandTotal,
                    'currency' => 'LKR'
                ]
            );
        } catch (Exception $e) {
            Log::error('Cart Calculation Error: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to calculate cart!', statusCode: 500);
        }
    }
}
