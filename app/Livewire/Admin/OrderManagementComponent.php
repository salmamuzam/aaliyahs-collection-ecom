<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use App\Mail\OrderApprovedMail;
use App\Mail\OrderCancelledMail;
use Illuminate\Support\Facades\Mail;

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

    public function approveOrder($orderId)
    {
        $order = Order::with(['user', 'items.product'])->find($orderId);
        if ($order) {
            $order->update(['status' => 'processing']);
            // Send the email
            Mail::to($order->user->email)->send(new OrderApprovedMail($order));
            session()->flash('message', "Order #{$order->id} has been moved to processing, and the user has been notified.");
        } else {
            session()->flash('error', "Order #{$orderId} not found.");
        }
    }

    public function cancelOrder($orderId)
    {
        $order = Order::with('user')->find($orderId);
        if ($order) {
            $order->update(['status' => 'cancelled']);
            // Send the email
            Mail::to($order->user->email)->send(new OrderCancelledMail($order));
            session()->flash('message', 'Order #' . $order->id . ' cancelled successfully, and the user has been notified!');
        }
    }

    public function render()
    {
        $query = Order::with(['user', 'items.product', 'address']);

        // Search functionality
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('id', 'like', '%' . $this->search . '%')
                    ->orWhere('grand_total', 'like', '%' . $this->search . '%')
                    ->orWhereHas('address', function ($q) {
                        $q->where('first_name', 'like', '%' . $this->search . '%')
                            ->orWhere('last_name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        // Handle customer sorting
        if ($this->sortColumn === 'customer') {
            $query->join('addresses', 'orders.id', '=', 'addresses.order_id')
                ->select('orders.*')
                ->orderBy('addresses.first_name', $this->sortOrder);
        } else {
            $query->orderBy($this->sortColumn, $this->sortOrder);
        }

        return view('livewire.admin.order-management-component', [
            'orders' => $query->paginate(5)
        ]);
    }
}
