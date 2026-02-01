<section class="text-black py-10 px-6 sm:px-8 bg-brand-burgundy bg-opacity-10">
    <div class="max-w-screen-xl mx-auto">
        <x-shared.section-header title="WHY US?" align="center" class="mb-8" />
        <div class="grid grid-cols-2 gap-y-12 gap-x-8 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
            <x-guest.home.feature-card :icon="asset('images/icons/delivery.png')" title="Island-wide Delivery" />
            <x-guest.home.feature-card :icon="asset('images/icons/click.png')" title="Click & Collect" />
            <x-guest.home.feature-card :icon="asset('images/icons/ethical.png')" title="Ethical & Responsible" />
            <x-guest.home.feature-card :icon="asset('images/icons/handcrafted.png')" title="Handcrafted Clothing" />
        </div>
    </div>
</section>

