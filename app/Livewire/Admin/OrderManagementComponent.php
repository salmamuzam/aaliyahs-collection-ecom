<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Events\OrderStatusUpdated;

use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class OrderManagementComponent extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $activePageNumber = 1;
    public $sortColumn = 'id';
    public $sortOrder = 'desc';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatingPage($pageNumber)
    {
        $this->activePageNumber = $pageNumber;
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
        // AUTHORIZATION (Exemplary Security Layer 2)
        if (!auth()->user()->user_type === 'admin') {
            abort(403);
        }

        $updateData = ['status' => 'processing'];

        // Only for stripe payment it must be paid, COD remains unpaid/pending
        if ($order->payment_method === 'stripe') {
            $updateData['payment_status'] = 'paid';
        }

        $order->update($updateData);
        OrderStatusUpdated::dispatch($order);
        session()->flash('message', "Order #{$order->id} is processing.");
    }

    public function cancelOrder(Order $order)
    {
        // AUTHORIZATION (Exemplary Security Layer 2)
        if (!auth()->user()->user_type === 'admin') {
            abort(403);
        }

        $order->update(['status' => 'cancelled']);
        OrderStatusUpdated::dispatch($order);
        session()->flash('message', "Order #{$order->id} cancelled.");
    }

    public function placeholder()
    {
        return view('livewire.admin.orders.list-skeleton');
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

        return view('livewire.admin.orders.order-management-component', [
            'orders' => $orders
        ]);
    }
}
