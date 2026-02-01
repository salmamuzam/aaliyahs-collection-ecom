<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 bg-brand-burgundy border border-transparent rounded-md font-medium text-[15px] text-white tracking-wide hover:bg-opacity-90 active:bg-opacity-100 focus:outline-none focus:ring-2 focus:ring-brand-burgundy focus:ring-offset-2 transition-colors shadow-md']) }}>
    {{ $slot }}
</button>
