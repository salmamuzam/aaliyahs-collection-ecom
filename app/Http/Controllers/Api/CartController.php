<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Requests\CartCalculationRequest;
use Exception;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Calculate Cart Totals (Helper for Client-side Carts).
     */
    public function calculate(CartCalculationRequest $request)
    {
        try {
            $items = collect($request->items)->map(function ($item) {
                $product = Product::find($item['product_id']);
                if (!$product)
                    return null;

                return [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $item['quantity'],
                    'line_total' => $product->price * $item['quantity'],
                    'image' => $product->images[0] ?? null,
                ];
            })->filter();

            return ResponseHelper::success(message: 'Cart calculated!', data: [
                'items' => $items,
                'grand_total' => $items->sum('line_total'),
                'currency' => 'lkr'
            ]);
        } catch (Exception $e) {
            Log::error('Cart Calc Error: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Calculation failed!', statusCode: 500);
        }
    }
}
