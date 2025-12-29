<div class="sm:px-8 px-4 py-6">
      <div class="max-w-screen-xl max-lg:max-w-xl mx-auto">
        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Order Summary (Left Column as per User Snippet) -->
          <div class="relative bg-white p-6 rounded-md shadow-sm border border-gray-300 h-fit">
            <h2 class="text-xl font-bold text-[#004D61] font-playfair mb-6">ORDER SUMMARY</h2>
            <div class="md:overflow-auto">
              <div class="space-y-4">
                @foreach($cart_items as $item)
                <div class="flex items-center gap-4 max-sm:flex-col">
                  <div class="w-24 h-auto shrink-0 rounded-md overflow-hidden aspect-[3/4]">
                    <img src="{{ url('storage', $item['image']) }}" class="w-full h-full object-cover object-top" />
                  </div>
                  <div class="w-full flex justify-between gap-4">
                    <div class="flex flex-col gap-4">
                        <h3 class="text-base font-bold text-[#1A1A1A]">{{ $item['name'] }}</h3>
                        <h6 class="text-base text-[#1A1A1A] font-normal">LKR {{ number_format($item['unit_amount'], 2) }}</h6>
                        <h6 class="text-base text-[#822659] font-bold">Total: LKR {{ number_format($item['total_amount'], 2) }}</h6>
                    </div>
                    <div>
                         <div class="flex items-center px-2.5 py-1.5 border border-gray-400 text-[#1A1A1A] text-xs font-medium outline-0 bg-[#ccdbdf] rounded-md">
                            <span class="mx-3"><span class="font-bold">Qty:</span> {{ $item['quantity'] }}</span>
                         </div>
                    </div>
                  </div>
                </div>
                <hr class="border-gray-300" />
                @endforeach
              </div>
              
              <div class="mt-6">
                <ul class="text-[#1A1A1A] font-medium space-y-4">
                  <li class="flex flex-wrap gap-4 text-base font-bold">Subtotal <span class="ml-auto font-normal text-[#1A1A1A]">LKR {{ number_format($grand_total, 2) }}</span></li>
                  <!-- User snippet has Shipping/Tax. Removing as per "NO NEED SHIPPING AND TAX LSO" instruction -->
                  <hr class="border-gray-300" />
                  <li class="flex flex-wrap gap-4 text-base font-bold text-[#1A1A1A]">Total <span class="ml-auto font-normal">LKR {{ number_format($grand_total, 2) }}</span></li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Form (Right Column) -->
          <div class="max-w-4xl w-full h-max rounded-md">
            <form wire:submit.prevent="placeOrder">
              <div>
                <h2 class="text-xl font-bold text-[#004D61] font-playfair mb-6">DELIVERY DETAILS</h2>
                <div class="grid gap-y-6 gap-x-4">
                  <div>
                    <label class="text-base text-[#1A1A1A] font-medium block mb-2">First Name</label>
                    <input wire:model="first_name" type="text" placeholder="Enter First Name"
                      class="px-4 py-2.5 bg-white border border-gray-400 text-[#1A1A1A] w-full text-base rounded-md focus:outline-none focus:border-[#822659] focus:ring-1 focus:ring-[#822659] @error('first_name') !border-[#822659] @enderror" />
                    @error('first_name') <span class="text-[#822659] text-base">{{ $message }}</span> @enderror
                  </div>
                  <div>
                    <label class="text-base text-[#1A1A1A] font-medium block mb-2">Last Name</label>
                    <input wire:model="last_name" type="text" placeholder="Enter Last Name"
                      class="px-4 py-2.5 bg-white border border-gray-400 text-[#1A1A1A] w-full text-base rounded-md focus:outline-none focus:border-[#822659] focus:ring-1 focus:ring-[#822659] @error('last_name') !border-[#822659] @enderror" />
                    @error('last_name') <span class="text-[#822659] text-base">{{ $message }}</span> @enderror
                  </div>
                  <div>
                    <label class="text-base text-[#1A1A1A] font-medium block mb-2">Email</label>
                    <input wire:model="email" type="email" placeholder="Enter Email"
                      class="px-4 py-2.5 bg-white border border-gray-400 text-[#1A1A1A] w-full text-base rounded-md focus:outline-none focus:border-[#822659] focus:ring-1 focus:ring-[#822659] @error('email') !border-[#822659] @enderror" />
                    @error('email') <span class="text-[#822659] text-base">{{ $message }}</span> @enderror
                  </div>
                  <div>
                    <label class="text-base text-[#1A1A1A] font-medium block mb-2">Phone No.</label>
                    <input wire:model="phone" type="number" placeholder="Enter Phone No."
                      class="px-4 py-2.5 bg-white border border-gray-400 text-[#1A1A1A] w-full text-base rounded-md focus:outline-none focus:border-[#822659] focus:ring-1 focus:ring-[#822659] @error('phone') !border-[#822659] @enderror" />
                    @error('phone') <span class="text-[#822659] text-base">{{ $message }}</span> @enderror
                  </div>
                  <div>
                    <label class="text-base text-[#1A1A1A] font-medium block mb-2">Address Line</label>
                    <input wire:model="street_address" type="text" placeholder="Enter Address Line"
                      class="px-4 py-2.5 bg-white border border-gray-400 text-[#1A1A1A] w-full text-base rounded-md focus:outline-none focus:border-[#822659] focus:ring-1 focus:ring-[#822659] @error('street_address') !border-[#822659] @enderror" />
                    @error('street_address') <span class="text-[#822659] text-base">{{ $message }}</span> @enderror
                  </div>
                  <div>
                    <label class="text-base text-[#1A1A1A] font-medium block mb-2">City</label>
                    <input wire:model="city" type="text" placeholder="Enter City"
                      class="px-4 py-2.5 bg-white border border-gray-400 text-[#1A1A1A] w-full text-base rounded-md focus:outline-none focus:border-[#822659] focus:ring-1 focus:ring-[#822659] @error('city') !border-[#822659] @enderror" />
                    @error('city') <span class="text-[#822659] text-base">{{ $message }}</span> @enderror
                  </div>
                  <div>
                    <label class="text-base text-[#1A1A1A] font-medium block mb-2">Province</label>
                    <input wire:model="province" type="text" placeholder="Enter Province"
                      class="px-4 py-2.5 bg-white border border-gray-400 text-[#1A1A1A] w-full text-base rounded-md focus:outline-none focus:border-[#822659] focus:ring-1 focus:ring-[#822659] @error('province') !border-[#822659] @enderror" />
                    @error('province') <span class="text-[#822659] text-base">{{ $message }}</span> @enderror
                  </div>
                  <div>
                    <label class="text-base text-[#1A1A1A] font-medium block mb-2">Postal Code</label>
                    <input wire:model="postal_code" type="text" placeholder="Enter Postal Code"
                      class="px-4 py-2.5 bg-white border border-gray-400 text-[#1A1A1A] w-full text-base rounded-md focus:outline-none focus:border-[#822659] focus:ring-1 focus:ring-[#822659] @error('postal_code') !border-[#822659] @enderror" />
                    @error('postal_code') <span class="text-[#822659] text-base">{{ $message }}</span> @enderror
                  </div>
                   <div>
                    <label class="text-base text-[#1A1A1A] font-medium block mb-2">Country</label>
                    <input type="text" value="Sri Lanka" readonly
                        class="px-4 py-2.5 bg-gray-100 border border-gray-400 text-[#1A1A1A] w-full text-base rounded-md focus:outline-none focus:border-[#822659] focus:ring-1 focus:ring-[#822659] cursor-not-allowed" />
                  </div>
                </div>
              </div>

              <div class="mt-10">
                <h2 class="text-xl font-bold text-[#004D61] font-playfair mb-6">PAYMENT</h2>
                 <!-- Payment modified to COD only as per user rule -->
                <div class="flex flex-wrap gap-y-6 gap-x-12 mt-4 mb-8">
                  <div class="flex items-center">
                    <input type="radio" wire:model="payment_method" value="cod" class="w-5 h-5 cursor-pointer text-[#822659] focus:ring-[#822659]" id="cod" checked />
                    <label for="cod" class="ml-4 flex gap-2 cursor-pointer font-medium text-[#1A1A1A] text-base">
                       Cash on Delivery
                    </label>
                  </div>
                </div>
                
                <div class="flex gap-4 max-lg:flex-col mt-8">
                  <a wire:navigate href="/shop" class="rounded-md px-4 py-2.5 w-full text-base font-medium tracking-wide bg-[#e6d3dd] hover:bg-[#d9c0d1] text-[#822659] max-lg:order-1 cursor-pointer text-center">Continue Shopping</a>
                  <button type="submit" class="rounded-md px-4 py-2.5 w-full text-base font-medium tracking-wide bg-[#3E5641] hover:bg-[#324534] text-white cursor-pointer">Place Order</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
