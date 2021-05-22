@props(['value', 'name'])
<input
    {{ $attributes->class(['form-input', 'form-input_error' => $errors->get($name)]) }}
    id="{{ $name }}"
    name="{{ $name }}"
    {{ $attributes->merge(['type' => 'text']) }}
    value="{{ $attributes->get('type') !== 'radio' ? (old($name) ?? $value ?? null) : $value }}"
/>