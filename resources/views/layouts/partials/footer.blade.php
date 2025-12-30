<footer class="px-10 py-10 tracking-wide bg-[#822659]">
    <div class="max-w-screen-xl mx-auto">
        <div class="flex flex-wrap items-center gap-6 md:justify-between max-md:flex-col">
            <div>
                <a href='javascript:void(0)'><img src="{{ asset('images/icons/white_logo.png')}}"
                        alt="Aaliyah's Collection Logo" class="h-10" /></a>
            </div>

            <ul class="flex flex-wrap items-center justify-center space-x-6 gap-y-2 md:justify-end">
                <li><a href="/" class="text-base text-white hover:underline" wire:navigate>Home</a></li>
                <li><a href="/shop" class="text-base text-white hover:underline" wire:navigate>Shop</a></li>
                <li><a href="#" class="text-base text-white hover:underline">Wishlist</a></li>
                <li><a href="/cart" class="text-base text-white hover:underline" wire:navigate>Cart</a></li>
            </ul>
        </div>

        <hr class="my-6 border-white" />

        <p class="text-base text-center text-white">© Aaliyah's Collection. All rights reserved.</p>
    </div>
</footer>
