<div class="bg-gray-100 rounded-md border border-gray-300 p-4 mt-8 text-brand-black">
    <h3 class="text-xl font-bold brand-heading-playfair mb-6 uppercase text-brand-teal">SHIPPING INFORMATION</h3>
    <div class="grid grid-cols-2 gap-4 lg:flex lg:flex-wrap lg:justify-between lg:w-full">
        <div>
            <p class="text-brand-black text-base font-bold">Customer</p>
            <p class="text-brand-black text-base font-medium mt-2">{{ $address->full_name }}</p>
        </div>
        <div class="max-sm:text-right">
            <p class="text-brand-black text-base font-bold">Order Status</p>
            <div class="mt-2 text-base font-medium">
                <x-customer.common.badge :status="$order->status" />
            </div>
        </div>
        <div>
            <p class="text-brand-black text-base font-bold">Address</p>
            <p class="text-brand-black text-base font-medium mt-2">{{ $address->street_address }}</p>
        </div>
        <div class="max-sm:text-right">
            <p class="text-brand-black text-base font-bold">Phone</p>
            <p class="text-brand-black text-base font-medium mt-2">{{ $address->phone }}</p>
        </div>
    </div>
</div>

