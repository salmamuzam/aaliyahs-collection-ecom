<div class="bg-gray-100 px-6 py-4 border-t border-gray-200">
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
        <p class="text-black text-sm font-medium">Need help? <a href="mailto:aaliyahscollection@gmail.com" class="text-black hover:underline font-bold">Contact us</a></p>
        <button wire:click="downloadInvoice" class="bg-brand-green hover:bg-opacity-90 text-white font-medium text-[15px] py-2 px-4 rounded-lg max-sm:-order-1 cursor-pointer transition duration-200 flex items-center gap-2">
            <svg wire:loading.remove wire:target="downloadInvoice" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
            </svg>
            <svg wire:loading wire:target="downloadInvoice" class="w-5 h-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Download Invoice
        </button>
    </div>
</div>
