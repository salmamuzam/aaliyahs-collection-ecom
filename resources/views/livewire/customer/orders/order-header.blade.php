<div class="px-6 py-4 bg-brand-teal">
    <div class="flex items-center justify-between gap-2">
        <h2 class="text-xl font-bold brand-heading-playfair text-white">ORDER DETAILS</h2>
        <x-customer.common.badge :status="$order->payment_status" class="px-2.5 py-1 rounded-full !bg-white !bg-opacity-100" />
    </div>
    <p class="text-slate-100 text-base mt-2">Here are the details of your order.</p>
</div>

