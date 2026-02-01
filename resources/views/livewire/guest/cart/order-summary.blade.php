<div class="sticky top-0 p-6 h-max brand-card">
    <x-shared.sections.section-header title="ORDER SUMMARY" size="text-lg" class="mb-0" />
    <ul class="mt-4 text-sm font-medium divide-y divide-gray-300 text-slate-500">
        <li class="flex items-center justify-between py-3"><span
                class="font-bold font-sans text-brand-black text-base">Subtotal</span> <span
                class="font-normal font-sans text-brand-black text-base">LKR
                {{ number_format($grand_total, 2) }}</span></li>
        <li class="flex items-center justify-between py-3 font-bold font-sans text-brand-black text-base">Total <span
                class="font-normal">LKR {{ number_format($grand_total, 2) }}</span></li>
    </ul>
    @if(count($cart_items) > 0)
        <a href="/checkout" wire:navigate
            class="block mt-6 text-base font-medium font-sans px-4 py-2.5 tracking-wide w-full bg-brand-green hover:bg-opacity-90 text-center text-white rounded-md cursor-pointer">Proceed
            to Checkout</a>
    @endif
</div>
