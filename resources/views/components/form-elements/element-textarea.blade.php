@props(['name', 'label', 'value' => ''])
<x-form-elements.form-group
    label="{{ $label }}"
    name="{{ $name }}"
>
    <textarea
        class="form-textarea"
        name="{{ $name }}"
        id="{{ $name }}"
    >{{ old($name) ?? $value ?? null }}</textarea>
</x-form-elements.form-group>