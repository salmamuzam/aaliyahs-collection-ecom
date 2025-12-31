<button {{ $attributes->merge(['type' => 'submit', 'class' => 'brand-btn-primary w-full']) }}>
    {{ $slot }}
</button>
