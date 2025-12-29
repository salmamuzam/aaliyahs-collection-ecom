<section class="py-4 md:py-6">
    <div class="p-6 mx-auto max-w-7xl max-lg:max-w-4xl">
        <h2 class="mb-2 text-xl font-bold font-playfair text-[#004D61] dark:text-white">THANKS FOR YOUR ORDER!</h2>
        <p class="mb-6 text-base text-[#1A1A1A] dark:text-gray-400 md:mb-8">Your order <a href="#"
                class="font-medium text-[#822659] hover:underline">{{ $order->id }}</a> has been received.</p>
        <div
            class="p-6 mb-6 space-y-4 border border-gray-300 rounded-md sm:space-y-2 bg-gray-50 dark:border-gray-700 dark:bg-gray-800 md:mb-8">
            <dl class="items-center justify-between gap-4 sm:flex">
                <dt class="mb-1 text-base font-bold text-[#1A1A1A] sm:mb-0 dark:text-gray-400">Date</dt>
                <dd class="text-base font-medium text-[#1A1A1A] dark:text-white sm:text-end">
                    {{ $order->created_at->format('d-m-Y') }}</dd>
            </dl>
            <dl class="items-center justify-between gap-4 sm:flex">
                <dt class="mb-1 text-base font-bold text-[#1A1A1A] sm:mb-0 dark:text-gray-400">Payment Method</dt>
                <dd class="text-base font-medium text-[#1A1A1A] dark:text-white sm:text-end">Cash on Delivery</dd>
            </dl>
            <dl class="items-center justify-between gap-4 sm:flex">
                <dt class="mb-1 text-base font-bold text-[#1A1A1A] sm:mb-0 dark:text-gray-400">Name</dt>
                <dd class="text-base font-medium text-[#1A1A1A] dark:text-white sm:text-end">
                    {{ $order->address->full_name }}</dd>
            </dl>
            <dl class="items-center justify-between gap-4 sm:flex">
                <dt class="mb-1 text-base font-bold text-[#1A1A1A] sm:mb-0 dark:text-gray-400">Address</dt>
                <dd class="text-base font-medium text-[#1A1A1A] dark:text-white sm:text-end">
                    {{ $order->address->street_address }}, {{ $order->address->city }}, {{ $order->address->province }},
                    {{ $order->address->postal_code }}, {{ $order->address->country }}</dd>
            </dl>
            <dl class="items-center justify-between gap-4 sm:flex">
                <dt class="mb-1 text-base font-bold text-[#1A1A1A] sm:mb-0 dark:text-gray-400">Phone</dt>
                <dd class="text-base font-medium text-[#1A1A1A] dark:text-white sm:text-end">
                    {{ $order->address->phone }}</dd>
            </dl>
            <dl class="items-center justify-between gap-4 sm:flex">
                <dt class="mb-1 text-base font-bold text-[#1A1A1A] sm:mb-0 dark:text-gray-400">Total</dt>
                <dd class="text-base font-bold text-[#822659] dark:text-white sm:text-end">LKR
                    {{ number_format($order->grand_total, 2) }}</dd>
            </dl>
        </div>
        <div class="flex gap-4 max-lg:flex-col">
            <a wire:navigate href="/my-orders"
                class="rounded-md px-4 py-2.5 w-full text-base font-medium tracking-wide bg-[#3E5641] hover:bg-[#324534] text-white cursor-pointer text-center">View
                your order</a>
            <a wire:navigate href="/shop"
                class="rounded-md px-4 py-2.5 w-full text-base font-medium tracking-wide bg-[#e6d3dd] hover:bg-[#d9c0d1] text-[#822659] cursor-pointer text-center">Return
                to shopping</a>
        </div>
    </div>
</section>
