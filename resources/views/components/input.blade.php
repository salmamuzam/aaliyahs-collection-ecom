@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'text-[#1A1A1A] text-base font-sans border border-slate-300 px-4 py-3 rounded-md focus:ring-[#3E5641] focus:border-[#3E5641] outline-none transition-all placeholder-gray-400 bg-white shadow-sm']) !!}>
