<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Order;

#[Title('Order Details - Aaliyah Collection')]
class OrderDetailPage extends Component
{
    public Order $order;

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function render()
    {
        return view('livewire.customer.orders.my-order-detail-page');
    }
}
