<?php

namespace App\Livewire\Customer;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Order Details | Aaliyah Collection')]
class MyOrderDetailPage extends Component
{
    public $order_id;

    // initialize order_id
    public function mount($order_id)
    {
        $this->order_id = $order_id;

    }

    public function placeholder()
    {
        return view('livewire.placeholders.my-order-detail-skeleton');
    }

    public function downloadInvoice()
    {
        $order = Order::where('id', $this->order_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $order_items = OrderItem::with('product')
            ->where('order_id', $order->id)
            ->get();

        $address = Address::where('order_id', $order->id)->first();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.invoice', [
            'order' => $order,
            'order_items' => $order_items,
            'address' => $address
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'invoice-' . $order->id . '.pdf');
    }

    public function render()
    {
        // fetch order and ensure it belongs to the authenticated user
        $order = Order::where('id', $this->order_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // fetch order items
        $order_items = OrderItem::with('product')
            ->where('order_id', $order->id)
            ->get();
        // fetch address
        $address = Address::where('order_id', $order->id)->first();

        return view('livewire.customer.my-order-detail-page', [
            'order_items' => $order_items,
            'address' => $address,
            'order' => $order,
        ]);
    }
}
