<div class="w-full">
    <div class="">
        <div class="p-6 mx-auto max-w-7xl max-lg:max-w-4xl">
            @include('livewire.includes.guest-alerts')
            <x-section-header title="YOUR SHOPPING CART" />

            <div class="relative grid gap-4 mt-6 lg:grid-cols-3">
                <div class="space-y-4 lg:col-span-2">
                    @forelse($cart_items as $item)
                        <div wire:key="{{ $item['product_id'] }}"
                            class="relative p-6 brand-card">
                            <div class="flex items-center gap-4 max-sm:flex-col max-sm:gap-6">
                                <div class="w-52 h-auto shrink-0 bg-gray-100 rounded-md overflow-hidden border border-gray-200 aspect-[3/4]">
                                    <img src='{{ url('storage', $item['image']) }}' class="object-cover object-top w-full h-full"
                                        alt="{{ $item['name'] }}" />
                                </div>
                                <div class="w-full sm:border-l sm:pl-4 sm:border-gray-300">
                                    <h3 class="mb-3 text-lg font-bold font-playfair text-brand-black capitalize">
                                        {{ $item['name'] }}
                                    </h3>
                                    <ul class="mb-4 text-sm font-sans text-brand-black space-y-2">
                                        <li>LKR {{ number_format($item['unit_amount'], 2) }}</li>
                                    </ul>

                                    <hr class="my-6 border-gray-300" />

                                    <div class="flex flex-wrap items-center justify-between gap-4">
                                        <div class="flex items-center gap-4">
                                             <h4 class="text-base font-sans text-brand-black">Qty:</h4>
                                             <button wire:click="decreaseQty({{ $item['product_id'] }})" type="button"
                                                 wire:loading.attr="disabled"
                                                 class="flex items-center justify-center w-[18px] h-[18px] bg-brand-green outline-none rounded-md cursor-pointer hover:bg-opacity-90">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="w-2 fill-white"
                                                     viewBox="0 0 124 124">
                                                     <path
                                                         d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z"
                                                         data-original="#000000"></path>
                                                 </svg>
                                             </button>
                                             <span
                                                 class="text-base font-sans text-brand-black leading-[16px]">{{ $item['quantity'] }}</span>
                                             <button wire:click="increaseQty({{ $item['product_id'] }})" type="button"
                                                 wire:loading.attr="disabled"
                                                 class="flex items-center justify-center w-[18px] h-[18px] bg-brand-green outline-none rounded-md cursor-pointer hover:bg-opacity-90">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="w-2 fill-white"
                                                     viewBox="0 0 42 42">
                                                     <path
                                                         d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z"
                                                         data-original="#000000"></path>
                                                 </svg>
                                             </button>
                                        </div>
                                        <div class="flex items-center">
                                            <h4 class="text-base font-bold font-sans text-brand-burgundy">
                                                LKR {{ number_format($item['total_amount'], 2) }}
                                            </h4>
                                            <button wire:click="removeItem({{ $item['product_id'] }})" type="button">
                                                <svg wire:loading.remove wire:target="removeItem({{ $item['product_id'] }})" xmlns="http://www.w3.org/2000/svg"
                                                    class="w-3 cursor-pointer shrink-0 fill-gray-400 hover:fill-brand-burgundy absolute top-3.5 right-3.5"
                                                    viewBox="0 0 320.591 320.591">
                                                    <path
                                                        d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                                                        data-original="#000000"></path>
                                                    <path
                                                        d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                                                        data-original="#000000"></path>
                                                </svg>
                                                <span wire:loading wire:target="removeItem({{ $item['product_id'] }})" class="text-lg font-sans text-brand-burgundy absolute top-3.5 right-3.5">Removing...</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        @include('livewire.includes.empty-state', [
                            'title' => 'Your shopping cart is empty!',
                            'icon' => '<path d="M20 7h-4V5c0-2.206-1.794-4-4-4S8 2.794 8 5v2H4c-1.103 0-2 .897-2 2v11c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V9c0-1.103-.897-2-2-2zM10 5c0-1.103.897-2 2-2s2 .897 2 2v2h-4V5zm10 15H4V9h4v2c0 .552.448 1 1 1s1-.448 1-1V9h4v2c0 .552.448 1 1 1s1-.448 1-1V9h4v11z" />'
                        ])
                    @endforelse

                </div>

                <div class="sticky top-0 p-6 h-max brand-card">
                    <x-section-header title="ORDER SUMMARY" size="text-lg" class="mb-0" />
                    <ul class="mt-4 text-sm font-medium divide-y divide-gray-300 text-slate-500">
                        <li class="flex items-center justify-between py-3"><span
                                class="font-bold font-sans text-brand-black text-base">Subtotal</span> <span
                                class="font-normal font-sans text-brand-black text-base">LKR
                                {{ number_format($grand_total, 2) }}</span></li>
                        <li class="flex items-center justify-between py-3 font-bold font-sans text-brand-black text-base">Total <span
                                class="font-normal">LKR {{ number_format($grand_total, 2) }}</span></li>
                    </ul>
                    @if(count($cart_items) > 0)
                        <a href="/checkout" wire:navigate
                            class="block mt-6 text-base font-medium font-sans px-4 py-2.5 tracking-wide w-full bg-brand-green hover:bg-opacity-90 text-center text-white rounded-md cursor-pointer">Proceed
                            to Checkout</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
