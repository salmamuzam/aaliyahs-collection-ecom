<div class="mt-8">
    <h3 class="text-xl font-bold brand-heading-playfair mb-6 uppercase text-brand-teal">ORDER ITEMS ({{ $order_items->count() }})</h3>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-x-12 lg:gap-y-4">
        @foreach($order_items as $item)
            <div wire:key="{{ $item->id }}" class="flex items-center gap-4 max-sm:flex-col lg:py-4 {{ !$loop->first ? 'max-sm:border-t max-sm:pt-4 max-sm:border-gray-300' : '' }}">
                <div class="w-24 h-auto shrink-0 rounded-md overflow-hidden aspect-[3/4] border border-gray-300">
                    <img src="{{ \App\Helpers\ImageHelper::getUrl($item->product->images[0]) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover object-top" />
                </div>
                <div class="flex-1 max-sm:text-center">
                    <h4 class="text-base font-medium text-brand-black">{{ $item->product->name }}</h4>
                    <div class="mt-2">
                         <div class="flex items-center px-2.5 py-1.5 border border-gray-400 text-brand-black text-xs font-medium font-sans outline-0 bg-brand-teal bg-opacity-10 rounded-md w-fit max-sm:mx-auto">
                            <span class="font-bold mr-1">Qty:</span> {{ $item->quantity }}
                        </div>
                    </div>
                </div>
                <div class="text-right max-sm:text-center max-sm:w-full">
                    <p class="text-brand-black text-base font-semibold">LKR {{ number_format($item->total_amount, 2) }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
