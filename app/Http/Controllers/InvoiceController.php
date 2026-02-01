<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Generate a professional PDF invoice for an order.
     */
    public function download(Order $order)
    {
        // Security: Ensure the user owns the order OR is an admin
        if (auth()->user()->user_type !== 'admin' && auth()->id() !== $order->user_id) {
            abort(403, 'Unauthorized access to this invoice.');
        }

        $order->load(['user', 'address', 'items.product']);

        $pdf = Pdf::loadView('pdf.invoice', [
            'order' => $order,
            'order_items' => $order->items,
            'address' => $order->address,
        ]);

        return $pdf->download("invoice-order-{$order->id}.pdf");
    }
}
