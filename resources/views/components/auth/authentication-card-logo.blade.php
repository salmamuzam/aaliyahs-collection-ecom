<a href="/" wire:navigate>
    {{-- Asset Helper Function: Generates a URL for the asset based on the application's base URL --}}
    {{-- $attributes: Includes additional attributes for this component --}}
    <img src="{{ asset('images/logo/dark_logo.png') }}" alt="Aaliyah's Collection Logo" class="h-24" {{ $attributes }}>
</a>
