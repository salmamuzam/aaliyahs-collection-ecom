<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use Livewire\Attributes\Title;
use Livewire\Component;

class OrderDetail extends Component
{
    #[Title('Order Details | Admin')]

    public $orderId;

    public function mount($order)
    {
        $this->orderId = $order;
    }

    public function placeholder()
    {
        return view('livewire.placeholders.order-detail-skeleton');
    }

    public function render()
    {
        $order = Order::with(['user', 'address', 'items.product'])->findOrFail($this->orderId);

        return view('livewire.admin.order-detail', [
            'order' => $order
        ]);
    }
}
