<div class="w-full max-w-4xl p-6 h-max brand-card">
    <form wire:submit.prevent="placeOrder">
        @csrf
        <div>
        <!-- Offline Message -->

        <x-shared.sections.section-header title="DELIVERY DETAILS" size="text-xl" />
        <div class="grid gap-y-6 gap-x-4">
          <x-shared.forms.input label="First Name" name="first_name" wire:model.live="first_name" placeholder="Enter First Name" readonly class="bg-gray-100 cursor-not-allowed" />
          <x-shared.forms.input label="Last Name" name="last_name" wire:model.live="last_name" placeholder="Enter Last Name"
              :readonly="!empty($last_name)"
              class="{{ !empty($last_name) ? 'bg-gray-100 cursor-not-allowed' : 'bg-white' }}" />
          <x-shared.forms.input label="Email" name="email" wire:model.live="email" type="email" placeholder="Enter Email" readonly class="bg-gray-100 cursor-not-allowed" />
          <x-shared.forms.input label="Phone No." name="phone" wire:model.live="phone" type="number" placeholder="Enter Phone No." />
          <x-shared.forms.input label="Address Line" name="street_address" wire:model.live="street_address" placeholder="Enter Address Line" />
          <x-shared.forms.input label="City" name="city" wire:model.live="city" placeholder="Enter City" />
          <x-shared.forms.input label="Province" name="province" wire:model.live="province" placeholder="Enter Province" />
          <x-shared.forms.input label="Postal Code" name="postal_code" wire:model.live="postal_code" placeholder="Enter Postal Code" />
           <div>
            <label class="block mb-2 text-base font-medium text-brand-black">Country</label>
            <input type="text" value="Sri Lanka" readonly
                class="px-4 py-2.5 bg-gray-100 border border-gray-400 text-brand-black w-full text-base rounded-md focus:outline-none focus:border-brand-burgundy focus:ring-1 focus:ring-brand-burgundy cursor-not-allowed" />
          </div>
        </div>
      </div>

      <div class="mt-10">
        <x-shared.sections.section-header title="PAYMENT" size="text-xl" />
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
