<div class="bg-gray-100 rounded-md border border-gray-300 p-4 mt-8">
    <h3 class="text-xl font-bold brand-heading-playfair mb-6 uppercase text-brand-teal">ORDER SUMMARY</h3>
    <div class="space-y-4">
        <div class="flex justify-between">
            <p class="text-base text-brand-black font-bold">Subtotal</p>
            <p class="text-brand-black text-base font-normal">LKR {{ number_format($order->grand_total, 2) }}</p>
        </div>
        <div class="flex justify-between pt-3 border-t border-gray-300">
            <p class="text-[15px] font-bold text-brand-black">Total</p>
            <p class="text-[15px] font-semibold text-brand-teal">LKR {{ number_format($order->grand_total, 2) }}</p>
        </div>
    </div>
</div>
