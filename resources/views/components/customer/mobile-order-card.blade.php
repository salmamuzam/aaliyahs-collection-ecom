@props(['order'])

<div class="p-4 space-y-3 brand-card">
    <div class="flex items-center justify-between text-base">
        <div class="flex items-center gap-2">
            <div>
                <a wire:navigate href="/my-orders/{{ $order->id }}" class="text-brand-teal font-bold hover:underline">#{{ $order->id }}</a>
            </div>
            <div class="font-sans text-brand-black">{{ $order->created_at->format('d/m/Y') }}</div>
        </div>
        <div>
            <x-customer.badge :status="$order->status" />
        </div>
    </div>
    <div class="text-base font-sans text-brand-black">
        <span class="font-bold">Payment:</span>
        <x-customer.badge :status="$order->payment_status" />
    </div>
    <div class="text-base font-medium font-sans text-brand-black">
        LKR {{ number_format($order->grand_total, 2) }}
    </div>
    <div>
        <a wire:navigate href="/my-orders/{{ $order->id }}" class="text-brand-teal hover:underline text-base font-medium">View details →</a>
    </div>
</div>
