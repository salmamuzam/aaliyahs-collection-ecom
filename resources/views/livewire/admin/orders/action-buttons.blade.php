<div class="flex items-center justify-center gap-2">
    <a wire:navigate href="{{ route('admin.orders.view', $order->id) }}" title="View Details"
        class="p-2 text-amber-600 hover:bg-amber-50 rounded-md transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
    </a>
    @if($order->status == 'new' || $order->status == 'cancelled')
        <button type="button" wire:click="approveOrder({{ $order->id }})" wire:loading.attr="disabled" wire:target="approveOrder({{ $order->id }}), cancelOrder({{ $order->id }})" title="Approve"
            class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-md cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none">
            <svg wire:loading.remove wire:target="approveOrder({{ $order->id }})" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <svg wire:loading wire:target="approveOrder({{ $order->id }})" class="brand-spinner h-5 w-5 text-emerald-600" style="shape-rendering: optimizeSpeed;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </button>
    @endif

    @if($order->status == 'new' || $order->status == 'processing')
        <button type="button" wire:click="cancelOrder({{ $order->id }})" wire:loading.attr="disabled" wire:target="approveOrder({{ $order->id }}), cancelOrder({{ $order->id }})" title="Cancel"
            class="p-2 text-rose-600 hover:bg-rose-50 rounded-md cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none">
            <svg wire:loading.remove wire:target="cancelOrder({{ $order->id }})" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <svg wire:loading wire:target="cancelOrder({{ $order->id }})" class="brand-spinner h-5 w-5 text-rose-600" style="shape-rendering: optimizeSpeed;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </button>
    @endif
</div>
