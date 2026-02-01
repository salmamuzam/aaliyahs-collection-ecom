<tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
    <td class="p-3 text-base font-sans text-brand-black whitespace-nowrap text-center">
        <a wire:navigate href="/my-orders/{{ $order->id }}" class="font-bold text-blue-500 hover:underline">#{{ $order->id }}</a>
    </td>
    <td class="p-3 text-base font-sans text-brand-black whitespace-nowrap text-center">
        {{ $order->created_at->format('d/m/Y') }}
    </td>
    <td class="p-3 text-base font-sans text-brand-black whitespace-nowrap">
        <div class="flex justify-center">
            <x-customer.common.badge :status="$order->status" />
        </div>
    </td>
    <td class="p-3 text-base font-sans text-brand-black whitespace-nowrap">
        <div class="flex justify-center">
            <x-customer.common.badge :status="$order->payment_status" />
        </div>
    </td>
    <td class="p-3 text-base font-sans text-brand-black whitespace-nowrap font-medium text-center">
        LKR {{ number_format($order->grand_total, 2) }}
    </td>
    <td class="p-3 text-base font-sans text-brand-black whitespace-nowrap text-center">
        <a wire:navigate href="/my-orders/{{ $order->id }}" title="View"
            class="p-2 text-amber-600 hover:bg-amber-50 rounded-md transition-colors inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        </a>
    </td>
</tr>

