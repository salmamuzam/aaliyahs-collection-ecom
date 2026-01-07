<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Events\OrderStatusUpdated;

use Livewire\WithPagination;

class OrderManagementComponent extends Component
{
    use WithPagination;

    public $search = '';
    public $sortColumn = 'created_at';
    public $sortOrder = 'desc';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function sortBy($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortOrder = $this->sortOrder === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortOrder = 'asc';
        }
    }

    public function approveOrder(Order $order)
    {
        $order->update(['status' => 'processing']);
        OrderStatusUpdated::dispatch($order);
        session()->flash('message', "Order #{$order->id} is processing.");
    }

    public function cancelOrder(Order $order)
    {
        $order->update(['status' => 'cancelled']);
        OrderStatusUpdated::dispatch($order);
        session()->flash('message', "Order #{$order->id} cancelled.");
    }

    public function render()
    {
        $orders = Order::with(['user', 'items.product', 'address'])
            ->when($this->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('id', 'like', "%{$search}%")
                        ->orWhere('grand_total', 'like', "%{$search}%")
                        ->orWhereHas('address', fn($q) => $q->where('first_name', 'like', "%{$search}%")->orWhere('last_name', 'like', "%{$search}%"));
                });
            })
            ->when($this->sortColumn === 'customer', function ($query) {
                $query->join('addresses', 'orders.id', '=', 'addresses.order_id')
                    ->select('orders.*')
                    ->orderBy('addresses.first_name', $this->sortOrder);
            }, function ($query) {
                $query->orderBy($this->sortColumn, $this->sortOrder);
            })
            ->paginate(5);

        return view('livewire.admin.order-management-component', [
            'orders' => $orders
        ]);
    }
}
