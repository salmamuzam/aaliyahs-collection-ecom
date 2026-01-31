<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderConfirmationEmail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(OrderPlaced $event): void
    {
        \Illuminate\Support\Facades\Log::info('QUEUED LISTENER: Dispatching Mailable for Order ' . $event->order->id);
        
        \Illuminate\Support\Facades\Mail::to($event->order->user)->send(new \App\Mail\OrderPlaced($event->order));
    }
}
