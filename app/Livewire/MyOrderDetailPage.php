<?php

namespace App\Livewire;

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

    public function render()
    {
        // fetch order details
        $order_items = OrderItem::with('product')->where('order_id', $this->order_id)->get();
        // fetch address
        $address = Address::where('order_id', $this->order_id)->first();
        // fetch order
        $order = Order::where('id', $this->order_id)->first();
        return view('livewire.my-order-detail-page', [
            'order_items' => $order_items,
            'address' => $address,
            'order' => $order,
        ]);
    }
}
