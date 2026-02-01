<div class="w-full">
    <div class="">
        <div class="px-6 pt-6 pb-6 mx-auto max-w-7xl max-lg:max-w-4xl">
            <x-customer.common.page-header title="YOUR ORDERS" />

        @if(count($orders) > 0)
        <!-- Desktop Table View -->
        <div class="hidden overflow-auto bg-white border border-gray-300 rounded-md shadow-sm md:block">
            <table class="w-full">
                <thead class="brand-table-thead">
                    <tr>
                        <th class="brand-table-th">Order ID</th>
                        <th class="brand-table-th">Date</th>
                        <th class="brand-table-th">Status</th>
                        <th class="brand-table-th">Payment</th>
                        <th class="brand-table-th">Total</th>
                        <th class="brand-table-th">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($orders as $order)
                        @include('livewire.customer.orders.order-row')
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:hidden">
            @foreach($orders as $order)
                <x-customer.orders.mobile-card :order="$order" />
            @endforeach
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="mt-6 mb-4 uppercase text-base font-medium">
                {{ $orders->links() }}
            </div>
        @endif
        @else
            <div class="col-span-full relative w-full p-6 mx-auto brand-card">
                @include('livewire.guest.partials.empty-state', [
                    'title' => 'No orders found!',
                    'stroke' => true,
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />'
                ])
            </div>
        @endif
        </div>
    </div>
</div>

