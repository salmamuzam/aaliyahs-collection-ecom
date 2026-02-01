@props(['order'])

<div class="bg-white p-4 brand-card relative">
    <div class="flex justify-between items-start mb-2">
        <span class="text-base font-medium font-sans text-brand-black">#{{ $order->id }}</span>
        <x-admin.orders.status-badge :status="$order->status" />
    </div>
    <p class="text-base font-medium font-sans text-brand-black mb-3">
        {{ $order->user ? ($order->user->first_name . ' ' . $order->user->last_name) : 
           ($order->address ? ($order->address->first_name . ' ' . $order->address->last_name) : 'Guest') }}
    </p>

    <div class="flex items-center gap-2 mb-3">
        <span class="text-base font-bold text-brand-black">Payment:</span>
        <x-admin.orders.payment-status-badge :status="$order->payment_status" />
    </div>

    <div class="flex justify-between items-center">
        <span class="text-base font-medium font-sans text-brand-black">LKR {{ number_format($order->grand_total, 2) }}</span>
        
        @if(isset($actions))
             <div class="flex space-x-2">
                {{ $actions }}
             </div>
        @endif
    </div>
</div>

