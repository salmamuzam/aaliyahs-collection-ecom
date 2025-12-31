@props(['label', 'name', 'type' => 'text', 'hasError' => null, 'errorMessage' => null])

@php
    // Simple, reliable error detection
    $fieldHasError = $hasError ?? ($errors->has($name) || ($name === 'login' && ($errors->has('email') || $errors->has('username'))));
    $displayError = $errorMessage ?? ($errors->first($name) ?: ($name === 'login' ? ($errors->first('email') ?: $errors->first('username')) : null));

    // Clean up technical messages
    if ($displayError) {
        $lowered = strtolower($displayError);
        
        // 1. All Required fields (Check for the word "required" in the message)
        if (str_contains($lowered, 'required')) {
            $displayError = 'This field is required!';
        }
        
        // 2. Login field incorrect (not required)
        elseif ($name === 'login' && (str_contains($lowered, 'incorrect') || str_contains($lowered, 'check') || str_contains($lowered, 'match'))) {
            $displayError = 'The username or email is incorrect!';
        }
        
        // 3. 2FA Code incorrect
        elseif ($name === 'code' && (str_contains($lowered, 'invalid') || str_contains($lowered, 'wrong') || str_contains($lowered, 'incorrect'))) {
            $displayError = 'The code is incorrect!';
        }
        
        // 4. Recovery Code incorrect
        elseif ($name === 'recovery_code' && (str_contains($lowered, 'invalid') || str_contains($lowered, 'wrong') || str_contains($lowered, 'incorrect'))) {
            $displayError = 'The recovery code is incorrect!';
        }
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
        <span class="text-brand-burgundy text-base mt-1 block">{{ $displayError }}</span>
    @endif
</div>