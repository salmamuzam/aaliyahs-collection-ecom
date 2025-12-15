<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#3E5641] dark:bg-[#3E5641] border border-transparent rounded-lg font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-[#004D61] dark:hover:bg-[#004D61] focus:bg-pink-700 dark:focus:bg-[#004D61] active:bg-[#004D61] dark:active:bg-[#004D61] focus:outline-none focus:ring-2 focus:ring-[#004D61] focus:ring-offset-2 dark:focus:ring-offset-[#004D61] disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
