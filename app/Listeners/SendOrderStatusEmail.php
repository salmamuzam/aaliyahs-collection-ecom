<?php

namespace App\Listeners;

use App\Events\OrderStatusUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderApprovedMail;
use App\Mail\OrderCancelledMail;

class SendOrderStatusEmail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(OrderStatusUpdated $event): void
    {
        $order = $event->order;
        $status = $order->status;

        try {
            if ($status == 'processing') {
                Mail::to($order->user->email)->send(new OrderApprovedMail($order));
            } elseif ($status == 'cancelled') {
                Mail::to($order->user->email)->send(new OrderCancelledMail($order));
            }
        } catch (\Exception $e) {
            Log::error('Failed to send order status email: ' . $e->getMessage());
        }
    }
}
