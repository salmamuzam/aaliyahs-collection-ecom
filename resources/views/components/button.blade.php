<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 bg-[#3E5641] border border-transparent rounded-md font-medium text-[15px] text-white tracking-wide hover:bg-[#2c3e2f] focus:bg-[#2c3e2f] active:bg-[#2c3e2f] focus:outline-none focus:ring-2 focus:ring-[#3E5641] focus:ring-offset-2 transition-colors shadow-md']) }}>
    {{ $slot }}
</button>
