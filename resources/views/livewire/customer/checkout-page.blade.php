<div class="sm:px-8 px-4 py-6">
      <div class="max-w-screen-xl max-lg:max-w-xl mx-auto">
        @include('livewire.includes.guest-alerts')
        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Order Summary (Left Column) -->
          <div class="relative p-6 h-fit brand-card">
            <x-section-header title="ORDER SUMMARY" size="text-xl" />
            <div class="md:overflow-auto">
              <div class="space-y-4">
                @foreach($cart_items as $item)
                <div class="flex items-center gap-4 max-sm:flex-col">
                  <div class="w-24 h-auto shrink-0 rounded-md overflow-hidden aspect-[3/4]">
                    <img src="{{ url('storage', $item['image']) }}" class="w-full h-full object-cover object-top" />
                  </div>
                  <div class="w-full flex flex-col gap-2">
                    {{-- Header: Name + Qty --}}
                    <div class="flex items-start justify-between gap-2">
                        <h3 class="text-base font-bold text-brand-black pr-2">{{ $item['name'] }}</h3>
                        <div class="flex items-center px-2.5 py-1.5 border border-gray-400 text-brand-black text-xs font-medium outline-0 bg-brand-teal bg-opacity-10 rounded-md shrink-0">
                            <span class="mx-1"><span class="font-bold">Qty:</span> {{ $item['quantity'] }}</span>
                        </div>
                    </div>

                    {{-- Prices --}}
                    <div class="w-full flex flex-wrap items-center justify-between gap-2 md:flex-col md:items-start md:justify-start md:gap-1">
                        <h6 class="text-base text-brand-black font-normal">LKR {{ number_format($item['unit_amount'], 2) }}</h6>
                        <h6 class="text-base text-brand-burgundy font-bold">Total: LKR {{ number_format($item['total_amount'], 2) }}</h6>
                    </div>
                  </div>
                </div>
                <hr class="border-gray-300" />
                @endforeach
              </div>
              
              <div class="mt-6">
                <ul class="text-brand-black font-medium space-y-4">
                  <li class="flex flex-wrap gap-4 text-base font-bold">Subtotal <span class="ml-auto font-normal text-brand-black">LKR {{ number_format($grand_total, 2) }}</span></li>
                  <!-- User snippet has Shipping/Tax. Removing as per "NO NEED SHIPPING AND TAX LSO" instruction -->
                  <hr class="border-gray-300" />
                  <li class="flex flex-wrap gap-4 text-base font-bold text-brand-black">Total <span class="ml-auto font-normal">LKR {{ number_format($grand_total, 2) }}</span></li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Form (Right Column) -->
          <div class="max-w-4xl w-full h-max brand-card p-6">
            <form wire:submit.prevent="placeOrder">
              <div>
                <x-section-header title="DELIVERY DETAILS" size="text-xl" />
                <div class="grid gap-y-6 gap-x-4">
                  <x-form.input label="First Name" name="first_name" wire:model="first_name" placeholder="Enter First Name" readonly class="bg-gray-100 cursor-not-allowed" />
                  <x-form.input label="Last Name" name="last_name" wire:model="last_name" placeholder="Enter Last Name" 
                      :readonly="!empty($last_name)" 
                      class="{{ !empty($last_name) ? 'bg-gray-100 cursor-not-allowed' : 'bg-white' }}" />
                  <x-form.input label="Email" name="email" wire:model="email" type="email" placeholder="Enter Email" readonly class="bg-gray-100 cursor-not-allowed" />
                  <x-form.input label="Phone No." name="phone" wire:model="phone" type="number" placeholder="Enter Phone No." />
                  <x-form.input label="Address Line" name="street_address" wire:model="street_address" placeholder="Enter Address Line" />
                  <x-form.input label="City" name="city" wire:model="city" placeholder="Enter City" />
                  <x-form.input label="Province" name="province" wire:model="province" placeholder="Enter Province" />
                  <x-form.input label="Postal Code" name="postal_code" wire:model="postal_code" placeholder="Enter Postal Code" />
                   <div>
                    <label class="text-base text-brand-black font-medium block mb-2">Country</label>
                    <input type="text" value="Sri Lanka" readonly
                        class="px-4 py-2.5 bg-gray-100 border border-gray-400 text-brand-black w-full text-base rounded-md focus:outline-none focus:border-brand-burgundy focus:ring-1 focus:ring-brand-burgundy cursor-not-allowed" />
                  </div>
                </div>
              </div>

              <div class="mt-10">
                <x-section-header title="PAYMENT" size="text-xl" />
                 <!-- Payment modified to COD only as per user rule -->
                <div class="flex flex-wrap gap-y-6 gap-x-12 mt-4 mb-8">
                  <div class="flex items-center">
                    <input type="radio" wire:model="payment_method" value="cod" class="w-5 h-5 cursor-pointer text-brand-burgundy focus:ring-brand-burgundy" id="cod" checked />
                    <label for="cod" class="ml-4 flex gap-2 cursor-pointer font-medium text-brand-black text-base">
                       Cash on Delivery
                    </label>
                  </div>
                </div>
                
                <div class="flex gap-4 max-lg:flex-col mt-8">
                  <a wire:navigate href="/shop" class="rounded-md px-4 py-2.5 w-full text-base font-medium tracking-wide bg-brand-burgundy bg-opacity-10 hover:bg-opacity-20 text-brand-burgundy max-lg:order-1 cursor-pointer text-center transition-colors">Continue Shopping</a>
                  <button type="submit" class="rounded-md px-4 py-2.5 w-full text-base font-medium tracking-wide bg-brand-green hover:bg-opacity-90 text-white cursor-pointer transition-colors shadow-sm"><span wire:loading.remove>Place Order</span><span wire:loading>Processing...</span></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
