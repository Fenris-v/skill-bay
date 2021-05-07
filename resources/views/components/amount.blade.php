@props(['name' => 'amount', 'type' => 'text', 'value' => 1])
<div class="form-group">
    <div class="Amount Amount_product">
        <button class="Amount-remove" type="button"></button>
        <input
            class="Amount-input form-input"
            name="{{ $name }}"
            type="{{ $type }}"
            value="{{ $value}}"
        />
        <button class="Amount-add" type="button"></button>
    </div>
    @if($errors->get($name))
        <div class="form-error">{{ implode(', ', $errors->get($name)) }}</div>
    @endif
</div>