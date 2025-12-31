<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 bg-white border border-gray-300 rounded-md font-medium text-[15px] text-slate-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-green focus:ring-offset-2 disabled:opacity-25 transition-colors']) }}>
    {{ $slot }}
</button>
