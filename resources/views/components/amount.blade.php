@props([
    'name' => 'amount',
    'type' => 'text',
    'value' => 1,
    'buttonsType' => 'button',
    'changeAmount' => null
])
<div class="form-group">
    <div {{  $attributes->class(['Amount']) }}>
        <x-wrappers.button
            class="Amount-remove Amount-remove-cart"
            :type="$buttonsType"
        ></x-wrappers.button>
        <input
            class="Amount-input form-input"
            name="{{ $name }}"
            type="{{ $type }}"
            value="{{ $value}}"
        />
        <x-wrappers.button
            class="Amount-add Amount-add-cart"
            :type="$buttonsType"
        ></x-wrappers.button>
    </div>
    @if($errors->get($name))
        <div class="form-error">{{ implode(', ', $errors->get($name)) }}</div>
    @endif
</div>