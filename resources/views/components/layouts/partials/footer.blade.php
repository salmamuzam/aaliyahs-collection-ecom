<footer class="px-10 py-10 tracking-wide bg-brand-burgundy">
    <div class="max-w-screen-xl mx-auto">
        <div class="flex flex-wrap items-center gap-6 md:justify-between max-md:flex-col">
            <div>
                <a href='/' wire:navigate><img src="{{ asset('images/logo/white_logo.png')}}"
                        alt="Aaliyah's Collection Logo" class="h-10" /></a>
            </div>

            <ul class="flex flex-wrap items-center justify-center space-x-6 gap-y-2 md:justify-end">
                <li><a wire:navigate href="{{ url('/') }}" class="text-base text-white hover:underline">Home</a></li>
                <li><a wire:navigate href="{{ url('/shop') }}" class="text-base text-white hover:underline">Shop</a></li>
                <li><a wire:navigate href="{{ url('/wishlist') }}" class="text-base text-white hover:underline">Wishlist</a></li>
                <li><a wire:navigate href="{{ url('/cart') }}" class="text-base text-white hover:underline">Cart</a></li>
            </ul>
        </div>

        <hr class="my-6 border-white" />

        <p class="text-base text-center text-white">© Aaliyah's Collection. All rights reserved.</p>
    </div>
</footer>
