<div>
    {{-- Hero Section --}}
    @include('livewire.guest.home.hero-section')

    {{-- About Us Section --}}
    @include('livewire.guest.home.about-section')

    {{-- Categories Section --}}
    @include('livewire.guest.home.categories-grid', ['categories' => $this->categories])

    {{-- Best Sellers Section --}}
    @include('livewire.guest.home.best-sellers')

    {{-- Why Us Section --}}
    @include('livewire.guest.home.why-us')

    {{-- INNOVATION: Social Proof (Latest Reviews) --}}
    <livewire:guest.latest-reviews />
</div>
