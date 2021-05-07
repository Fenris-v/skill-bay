@props(['name', 'label'])
<x-form-elements.form-group
    label="{{ $label }}"
    name="{{ $name }}"
>
    <x-form-elements.input
        name="{{ $name }}"
        {{ $attributes }}
    />
</x-form-elements.form-group>