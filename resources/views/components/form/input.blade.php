@props(['label', 'name', 'type' => 'text', 'hasError' => null, 'errorMessage' => null])

@php
    // Simple, reliable error detection
    $fieldHasError = $hasError ?? ($errors->has($name) || ($name === 'login' && ($errors->has('email') || $errors->has('username'))));
    $displayError = $errorMessage ?? ($errors->first($name) ?: ($name === 'login' ? ($errors->first('email') ?: $errors->first('username')) : null));
    
    // Clean up technical technical messages if any remain
    if ($displayError && str_contains(strtolower($displayError), 'login field')) {
        $displayError = 'The email or username field is required.';
    }

    // Base classes
    $classes = "brand-form-input text-brand-black shadow-sm font-sans";
    if ($fieldHasError) {
        $classes .= " border-brand-burgundy focus:border-brand-burgundy focus:ring-1 focus:ring-brand-burgundy";
    }
@endphp

<div>
    <label class="text-brand-black text-base font-bold font-sans mb-2 block">{{ $label }}</label>
    <div class="relative flex items-center">
        <input name="{{ $name }}" type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }} />
        @if ($slot->isNotEmpty())
            <div class="absolute right-4 text-[#bbb]">
                {{ $slot }}
            </div>
        @endif
    </div>
    @if($displayError)
        <span class="text-brand-burgundy text-sm mt-1 block">{{ $displayError }}</span>
    @endif
</div>
