<div class="p-6 mb-6 space-y-4 border border-gray-300 rounded-md sm:space-y-2 bg-gray-50 dark:border-gray-700 dark:bg-gray-800 md:mb-8">
    <dl class="items-center justify-between gap-4 sm:flex">
        <dt class="mb-1 text-base font-bold text-brand-black sm:mb-0">Date</dt>
        <dd class="text-base font-medium text-brand-black sm:text-end">
            {{ $order->created_at->format('d-m-Y') }}</dd>
    </dl>
    <dl class="items-center justify-between gap-4 sm:flex">
        <dt class="mb-1 text-base font-bold text-brand-black sm:mb-0">Payment Method</dt>
        <dd class="text-base font-medium text-brand-black sm:text-end">
            {{ $order->payment_method == 'cod' ? 'Cash on Delivery' : 'Stripe' }}
        </dd>
    </dl>
    <dl class="items-center justify-between gap-4 sm:flex">
        <dt class="mb-1 text-base font-bold text-brand-black sm:mb-0">Name</dt>
        <dd class="text-base font-medium text-brand-black sm:text-end">
            {{ $order->address->full_name }}</dd>
    </dl>
    <dl class="items-center justify-between gap-4 sm:flex">
        <dt class="mb-1 text-base font-bold text-brand-black sm:mb-0">Address</dt>
        <dd class="text-base font-medium text-brand-black sm:text-end">
            {{ $order->address->street_address }}, {{ $order->address->city }}, {{ $order->address->province }},
            {{ $order->address->postal_code }}, {{ $order->address->country }}</dd>
    </dl>
    <dl class="items-center justify-between gap-4 sm:flex">
        <dt class="mb-1 text-base font-bold text-brand-black sm:mb-0">Phone</dt>
        <dd class="text-base font-medium text-brand-black sm:text-end">
            {{ $order->address->phone }}</dd>
    </dl>
    <dl class="items-center justify-between gap-4 sm:flex">
        <dt class="mb-1 text-base font-bold text-brand-black sm:mb-0">Total</dt>
        <dd class="text-base font-bold text-brand-burgundy sm:text-end">LKR
            {{ number_format($order->grand_total, 2) }}</dd>
    </dl>
</div>
