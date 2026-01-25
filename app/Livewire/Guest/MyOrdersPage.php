<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Order;

#[Title('My Orders - Aaliyah Collection')]
class MyOrdersPage extends Component
{
    public function render()
    {
        $orders = auth()->check() ? auth()->user()->orders()->latest()->paginate(5) : [];
        return view('livewire.guest.my-orders-page', [
            'orders' => $orders
        ]);
    }
}
