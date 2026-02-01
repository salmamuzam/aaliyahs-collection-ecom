<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use Livewire\Attributes\Title;
use Livewire\Attributes\Locked;
use Livewire\Component;

class OrderDetail extends Component
{
    #[Title('Order Details | Admin')]

    #[Locked]
    public $orderId;

    public function mount($order)
    {
        $this->orderId = $order;
    }

    public function placeholder()
    {
        return view('livewire.admin.orders.detail-skeleton');
    }

    public function render()
    {
        $order = Order::with(['user', 'address', 'items.product'])->findOrFail($this->orderId);

        return view('livewire.admin.orders.order-detail', [
            'order' => $order
        ]);
    }
}
