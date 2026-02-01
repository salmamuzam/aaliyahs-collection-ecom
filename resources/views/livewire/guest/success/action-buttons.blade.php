<div class="flex gap-4 max-lg:flex-col">
    <a wire:navigate href="/my-orders"
        class="rounded-md px-4 py-2.5 w-full text-base font-medium tracking-wide bg-brand-green hover:bg-opacity-90 text-white cursor-pointer text-center transition-colors">View
        your order</a>
    <a href="{{ route('order.invoice', $order->id) }}"
        class="rounded-md px-4 py-2.5 w-full text-base font-medium tracking-wide bg-brand-teal hover:bg-opacity-90 text-white cursor-pointer text-center transition-colors">
        <i class="fa-solid fa-file-pdf mr-2"></i> Download Invoice
    </a>
    <a wire:navigate href="/shop"
        class="rounded-md px-4 py-2.5 w-full text-base font-medium tracking-wide bg-brand-burgundy bg-opacity-10 hover:bg-opacity-20 text-brand-burgundy cursor-pointer text-center transition-colors">Return
        to shopping</a>
</div>
