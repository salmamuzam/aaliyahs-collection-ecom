<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderConfirmationEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPlaced $event): void
    {
        \Illuminate\Support\Facades\Log::info('LISTENER: Dispatching Mailable for Order ' . $event->order->id);

        \Illuminate\Support\Facades\Mail::to($event->order->user)->send(new \App\Mail\OrderPlaced($event->order));
    }
}
