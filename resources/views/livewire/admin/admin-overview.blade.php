<div wire:poll.30s class="px-6 lg:px-12 pt-6 lg:pt-10 pb-4 lg:pb-8 relative">

    <x-admin.page-header title="Dashboard" />

    <div class="pb-4">
        <div class="grid lg:grid-cols-4 sm:grid-cols-2 gap-x-6 gap-y-6 lg:max-w-full mx-auto">
            
            {{-- Total Categories --}}
            <x-admin.stats-card :href="route('categories')" :count="$totalCategories" label="Categories">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12 text-brand-teal" viewBox="0 0 24 24">
                    <path d="M18 2c2.206 0 4 1.794 4 4v12c0 2.206-1.794 4-4 4H6c-2.206 0-4-1.794-4-4V6c0-2.206 1.794-4 4-4zm0-2H6a6 6 0 0 0-6 6v12a6 6 0 0 0 6 6h12a6 6 0 0 0 6-6V6a6 6 0 0 0-6-6z" />
                    <path d="M12 18a1 1 0 0 1-1-1V7a1 1 0 0 1 2 0v10a1 1 0 0 1-1 1z" />
                    <path d="M6 12a1 1 0 0 1 1-1h10a1 1 0 0 1 0 2H7a1 1 0 0 1-1-1z" />
                </svg>
            </x-admin.stats-card>

            {{-- Total Products --}}
            <x-admin.stats-card :href="route('products')" :count="$totalProducts" label="Products">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12 text-brand-teal" viewBox="0 0 511.414 511.414">
                    <path d="M497.695 108.838a16.002 16.002 0 0 0-9.92-14.8L261.787 1.2a16.003 16.003 0 0 0-12.16 0L23.639 94.038a16 16 0 0 0-9.92 14.8v293.738a16 16 0 0 0 9.92 14.8l225.988 92.838a15.947 15.947 0 0 0 12.14-.001c.193-.064-8.363 3.445 226.008-92.837a16 16 0 0 0 9.92-14.8zm-241.988 76.886-83.268-34.207L352.39 73.016l88.837 36.495zm-209.988-51.67 71.841 29.513v83.264c0 8.836 7.164 16 16 16s16-7.164 16-16v-70.118l90.147 37.033v257.797L45.719 391.851zM255.707 33.297l55.466 22.786-179.951 78.501-61.035-25.074zm16 180.449 193.988-79.692v257.797l-193.988 79.692z" />
                </svg>
            </x-admin.stats-card>

            {{-- Total Orders --}}
            <x-admin.stats-card :href="route('admin.orders')" :count="$totalOrders" label="Orders">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12 text-brand-teal" viewBox="0 0 510 510">
                    <path d="M255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z" />
                    <path d="M267.75 127.5H229.5v153l132.6 81.6 20.4-33.15-114.75-68.85z" />
                </svg>
            </x-admin.stats-card>

             {{-- Total Customers --}}
            <x-admin.stats-card href="#" :count="$totalCustomers" label="Customers">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12 text-brand-teal" viewBox="0 0 24 24">
                     <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                </svg>
            </x-admin.stats-card>

        </div>
    </div>

    {{-- Recent Orders Table --}}
    <div class="mt-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl text-brand-teal brand-heading-playfair">Recent Orders</h2>
            <a wire:navigate href="{{ route('admin.orders') }}" class="text-brand-burgundy font-semibold hover:underline text-sm uppercase tracking-wider">View All Orders</a>
        </div>
        
        <div class="hidden md:block overflow-hidden brand-card">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white table-fixed">
                    <thead class="brand-table-thead">
                        <tr>
                            <th class="brand-table-th w-1/6">Order ID</th>
                            <th class="brand-table-th w-2/6">Customer</th>
                            <th class="brand-table-th w-1/6">Status</th>
                            <th class="brand-table-th w-1/6">Payment</th>
                            <th class="brand-table-th w-1/6">Total</th>

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 whitespace-nowrap">
                        @forelse($recentOrders as $order)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4 text-base text-brand-black font-medium font-sans text-center">#{{ $order->id }}</td>
                                <td class="p-4 text-base text-brand-black font-medium font-sans text-center">{{ $order->user->first_name . ' ' . $order->user->last_name ?? 'Guest' }}</td>
                                <td class="p-4 text-center font-sans">
                                    <x-admin.status-badge :status="$order->status" />
                                </td>
                                <td class="p-4 text-center">
                                    <x-admin.badge :variant="$order->payment_status == 'paid' ? 'success' : 'danger'">
                                        {{ $order->payment_status }}
                                    </x-admin.badge>
                                </td>
                                <td class="p-4 text-base text-brand-black font-medium font-sans text-center">LKR {{ number_format($order->grand_total, 2) }}</td>

                            </tr>
                        @empty
                            @include('livewire.includes.admin-no-results', ['message' => 'No recent orders found.', 'colspan' => 5])
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Mobile View --}}
        <div class="md:hidden space-y-4">
            @forelse($recentOrders as $order)
                <x-admin.mobile-order-card :order="$order" />
            @empty
                <div class="text-center p-6 bg-white brand-card">
                    <p class="text-gray-500">No recent orders found.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
