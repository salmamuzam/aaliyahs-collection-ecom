<div wire:poll.30s class="px-6 lg:px-12 pt-6 lg:pt-10 pb-4 lg:pb-8 relative">

    <x-admin.common.page-header title="Dashboard" />

    <div class="pb-4">
        @include('livewire.admin.dashboard.stats-grid')
    </div>

    {{-- Recent Orders Table --}}
    <div class="mt-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl text-brand-teal brand-heading-playfair">Recent Orders</h2>
            <a wire:navigate href="{{ route('admin.orders') }}" class="text-brand-burgundy font-semibold hover:underline text-sm uppercase tracking-wider">View All Orders</a>
        </div>
        
        @include('livewire.admin.dashboard.recent-orders-table')

        {{-- Mobile View --}}
        <div class="md:hidden space-y-4">
            @forelse($recentOrders as $order)
                <x-admin.orders.mobile-card :order="$order" />
            @empty
                <div class="text-center p-6 bg-white brand-card">
                    <p class="text-gray-500">No recent orders found.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

