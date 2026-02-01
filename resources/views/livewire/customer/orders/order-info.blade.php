<div class="flex flex-wrap justify-between items-center gap-4">
    <div class="max-sm:w-[48%]">
        <p class="text-brand-black text-base font-bold">Order Number</p>
        <p class="text-brand-black text-base font-medium mt-2">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
    </div>
    <div class="max-sm:w-[48%] max-sm:text-right">
        <p class="text-brand-black text-base font-bold">Date</p>
        <p class="text-brand-black text-base font-medium mt-2">{{ $order->created_at->format('F d, Y') }}</p>
    </div>
    <div class="max-sm:w-full max-sm:flex max-sm:justify-between max-sm:items-center max-sm:mt-2 max-sm:pt-2 max-sm:border-t max-sm:border-gray-200">
        <p class="text-brand-black text-base font-bold">Total</p>
        <p class="text-base font-medium mt-2 text-brand-teal">LKR {{ number_format($order->grand_total, 2) }}</p>
    </div>
</div>
