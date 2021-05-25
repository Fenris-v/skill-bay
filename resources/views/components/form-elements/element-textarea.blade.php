@props(['name', 'label', 'value' => ''])
<x-form-elements.form-group
    label="{{ $label }}"
    name="{{ $name }}"
>
    <textarea
        {{ $attributes->class(['form-textarea', 'form-textarea_error' => $errors->get($name)]) }}
        name="{{ $name }}"
        id="{{ $name }}"
    >{{ old($name) ?? $value ?? null }}</textarea>
</x-form-elements.form-group>