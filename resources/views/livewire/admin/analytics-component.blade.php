<div class="px-6 lg:px-12 pt-6 lg:pt-10 pb-4 lg:pb-8">
    <x-admin.page-header title="Platform Analytics" />

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- High Value Customers Table (Integrated Stored Procedure) --}}
        <div class="brand-card overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-300 bg-gray-50 flex justify-between items-center">
                <h3 class="text-base font-bold text-brand-teal uppercase">VIP CUSTOMERS (Stored Procedure)</h3>
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold text-gray-500">Min spent:</span>
                    <input type="number" wire:model.live="minSpent" class="w-20 p-1 text-xs border border-gray-300 rounded outline-none text-brand-black">
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white whitespace-nowrap">
                    <thead class="brand-table-thead">
                        <tr>
                            <th class="brand-table-th">Customer</th>
                            <th class="brand-table-th">Email</th>
                            <th class="brand-table-th">Total Spent</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($highValueCustomers as $customer)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4 text-sm font-medium text-brand-black">{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                <td class="p-4 text-sm text-gray-600">{{ $customer->email }}</td>
                                <td class="p-4 text-sm font-bold text-brand-burgundy">LKR {{ number_format($customer->total_spent, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-10 text-center text-gray-500 italic">No VIP customers found for this criteria.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Database Integrity Insights --}}
        <div class="space-y-6">
            <div class="brand-card p-6 bg-brand-burgundy text-white">
                <h3 class="text-lg font-bold mb-2 flex items-center gap-2">
                    <i class="fa-solid fa-bolt"></i> Database Triggers Active
                </h3>
                <p class="text-sm opacity-90 leading-relaxed">
                    Platform analytics like <strong>Last Order Date</strong> and <strong>Lifetime Spend</strong> are being calculated automatically using <strong>SQL Triggers</strong> for 100% data integrity and zero server overhead.
                </p>
            </div>
            
            <div class="brand-card p-6 border-l-4 border-brand-teal">
                <h3 class="text-lg font-bold text-brand-teal mb-2">Performance Optimization</h3>
                <ul class="text-sm text-brand-black space-y-2">
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-check-circle text-brand-green"></i> 
                        Multiple performance indexes on Status, Price, and Name.
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-check-circle text-brand-green"></i> 
                        Parameterized queries via Eloquent to block SQL Injection.
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-check-circle text-brand-green"></i> 
                        ACID compliant transactions for Checkout flows.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
