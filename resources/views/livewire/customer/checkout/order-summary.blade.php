<div class="relative p-6 h-fit brand-card">
    <x-shared.sections.section-header title="ORDER SUMMARY" size="text-xl" />
    <div class="md:overflow-auto">
      <div class="space-y-4">
        @foreach($cart_items as $item)
        <div class="flex items-center gap-4 max-sm:flex-col">
          <div class="w-24 h-auto shrink-0 rounded-md overflow-hidden aspect-[3/4]">
            <img src="{{ \App\Helpers\ImageHelper::getUrl($item['image']) }}" class="object-cover object-top w-full h-full" />
          </div>
          <div class="flex flex-col w-full gap-2">
            {{-- Header: Name + Qty --}}
            <div class="flex items-start justify-between gap-2">
                <h3 class="pr-2 text-base font-bold text-brand-black">{{ $item['name'] }}</h3>
                <div class="flex items-center px-2.5 py-1.5 border border-gray-400 text-brand-black text-xs font-medium outline-0 bg-brand-teal bg-opacity-10 rounded-md shrink-0">
                    <span class="mx-1"><span class="font-bold">Qty:</span> {{ $item['quantity'] }}</span>
                </div>
            </div>

            {{-- Prices --}}
            <div class="flex flex-wrap items-center justify-between w-full gap-2 md:flex-col md:items-start md:justify-start md:gap-1">
                <h6 class="text-base font-normal text-brand-black">LKR {{ number_format($item['unit_amount'], 2) }}</h6>
                <h6 class="text-base font-bold text-brand-burgundy">Total: LKR {{ number_format($item['total_amount'], 2) }}</h6>
            </div>
          </div>
        </div>
        <hr class="border-gray-300" />
        @endforeach
      </div>

      <div class="mt-6">
        <ul class="space-y-4 font-medium text-brand-black">
          <li class="flex flex-wrap gap-4 text-base font-bold">Subtotal <span class="ml-auto font-normal text-brand-black">LKR {{ number_format($grand_total, 2) }}</span></li>
          <!-- User snippet has Shipping/Tax. Removing as per "NO NEED SHIPPING AND TAX LSO" instruction -->
          <hr class="border-gray-300" />
          <li class="flex flex-wrap gap-4 text-base font-bold text-brand-black">Total <span class="ml-auto font-normal">LKR {{ number_format($grand_total, 2) }}</span></li>
        </ul>
      </div>
    </div>
</div>
