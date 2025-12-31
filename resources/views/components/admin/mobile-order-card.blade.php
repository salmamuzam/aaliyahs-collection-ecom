@props(['order'])

@php
    $statusClasses = [
        'new' => 'bg-blue-50 text-blue-700 border-blue-100',
        'processing' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
        'shipped' => 'bg-amber-50 text-amber-700 border-amber-100',
        'delivered' => 'bg-teal-50 text-teal-700 border-teal-100',
        'cancelled' => 'bg-rose-50 text-rose-700 border-rose-100',
    ];
    // Attempt to map variant or just pass classes if logic is external? 
    // Actually logic is internal for status colors here
    $variantMap = [
        'new' => 'info',
        'processing' => 'success', // or primary
        'shipped' => 'warning',
        'delivered' => 'teal',
        'cancelled' => 'danger',
    ];
    $badgeVariant = $variantMap[$order->status] ?? 'default';
@endphp

<div class="bg-white p-4 brand-card relative">
    <div class="flex justify-between items-start mb-2">
        <span class="text-base font-medium font-sans text-brand-black">#{{ $order->id }}</span>
        <x-admin.badge :variant="$badgeVariant">
            {{ $order->status }}
        </x-admin.badge>
    </div>
    <p class="text-base font-medium font-sans text-brand-black mb-3">
        {{ $order->user ? ($order->user->first_name . ' ' . $order->user->last_name) : 
           ($order->address ? ($order->address->first_name . ' ' . $order->address->last_name) : 'Guest') }}
    </p>

    <div class="flex items-center gap-2 mb-3">
        <span class="text-base font-bold text-brand-black">Payment:</span>
        <x-admin.badge :variant="$order->payment_status == 'paid' ? 'success' : 'danger'">
            {{ $order->payment_status }}
        </x-admin.badge>
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
