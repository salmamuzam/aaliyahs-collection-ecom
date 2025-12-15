@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-[#1A1A1A] dark:bg-[#F0F0F0] dark:text-[#1A1A1A] focus:border-[#004D61] dark:focus:border-[#004D61] focus:ring-[#822659] dark:focus:ring-[#822659] rounded-lg']) !!}>
