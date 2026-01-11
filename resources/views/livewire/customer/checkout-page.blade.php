<div class="px-4 py-6 sm:px-8">
      <div class="max-w-screen-xl mx-auto max-lg:max-w-xl">
        @include('livewire.includes.guest-alerts')
        <div class="grid gap-12 lg:grid-cols-2">
            <!-- Order Summary (Left Column) -->
          <div class="relative p-6 h-fit brand-card">
            <x-section-header title="ORDER SUMMARY" size="text-xl" />
            <div class="md:overflow-auto">
              <div class="space-y-4">
                @foreach($cart_items as $item)
                <div class="flex items-center gap-4 max-sm:flex-col">
                  <div class="w-24 h-auto shrink-0 rounded-md overflow-hidden aspect-[3/4]">
                    <img src="{{ url('storage', $item['image']) }}" class="object-cover object-top w-full h-full" />
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

          <!-- Form (Right Column) -->
          <div class="w-full max-w-4xl p-6 h-max brand-card">
            <form wire:submit.prevent="placeOrder">
                @csrf
                <div>
                <!-- Offline Message -->

                <x-section-header title="DELIVERY DETAILS" size="text-xl" />
                <div class="grid gap-y-6 gap-x-4">
                  <x-form.input label="First Name" name="first_name" wire:model.live="first_name" placeholder="Enter First Name" readonly class="bg-gray-100 cursor-not-allowed" />
                  <x-form.input label="Last Name" name="last_name" wire:model.live="last_name" placeholder="Enter Last Name"
                      :readonly="!empty($last_name)"
                      class="{{ !empty($last_name) ? 'bg-gray-100 cursor-not-allowed' : 'bg-white' }}" />
                  <x-form.input label="Email" name="email" wire:model.live="email" type="email" placeholder="Enter Email" readonly class="bg-gray-100 cursor-not-allowed" />
                  <x-form.input label="Phone No." name="phone" wire:model.live="phone" type="number" placeholder="Enter Phone No." />
                  <x-form.input label="Address Line" name="street_address" wire:model.live="street_address" placeholder="Enter Address Line" />
                  <x-form.input label="City" name="city" wire:model.live="city" placeholder="Enter City" />
                  <x-form.input label="Province" name="province" wire:model.live="province" placeholder="Enter Province" />
                  <x-form.input label="Postal Code" name="postal_code" wire:model.live="postal_code" placeholder="Enter Postal Code" />
                   <div>
                    <label class="block mb-2 text-base font-medium text-brand-black">Country</label>
                    <input type="text" value="Sri Lanka" readonly
                        class="px-4 py-2.5 bg-gray-100 border border-gray-400 text-brand-black w-full text-base rounded-md focus:outline-none focus:border-brand-burgundy focus:ring-1 focus:ring-brand-burgundy cursor-not-allowed" />
                  </div>
                </div>
              </div>

              <div class="mt-10">
                <x-section-header title="PAYMENT" size="text-xl" />
                 <!-- Payment modified to COD only as per user rule -->
                <div class="flex flex-wrap mt-4 mb-8 gap-y-6 gap-x-12">
                  <div class="flex items-center">
                    <input type="radio" wire:model="payment_method" value="cod" class="w-5 h-5 cursor-pointer text-brand-burgundy focus:ring-brand-burgundy" id="cod" checked />
                    <label for="cod" class="flex gap-2 ml-4 text-base font-medium cursor-pointer text-brand-black">
                       Cash on Delivery
                    </label>
                  </div>
                  <div class="flex items-center">
                    <input type="radio" wire:model="payment_method" value="stripe" class="w-5 h-5 cursor-pointer text-brand-burgundy focus:ring-brand-burgundy" id="stripe" />
                    <label for="stripe" class="flex gap-2 ml-4 text-base font-medium cursor-pointer text-brand-black">
                       Pay Online (Stripe)
                    </label>
                  </div>
                </div>

                <div class="flex gap-4 mt-8 max-lg:flex-col">
                  <a wire:navigate href="/shop" class="rounded-md px-4 py-2.5 w-full text-base font-medium tracking-wide bg-brand-burgundy bg-opacity-10 hover:bg-opacity-20 text-brand-burgundy max-lg:order-1 cursor-pointer text-center transition-colors">Continue Shopping</a>
                  <button type="submit" class="rounded-md px-4 py-2.5 w-full text-base font-medium tracking-wide bg-brand-green hover:bg-opacity-90 text-white cursor-pointer transition-colors shadow-sm"><span wire:loading.remove>Place Order</span><span wire:loading>Processing...</span></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
