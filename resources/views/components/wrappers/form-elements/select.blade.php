@props(['items', 'name'])
<select {{ $attributes->merge(['class' => 'form-select']) }} name="{{ $name }}">
    @foreach($items as $item)
        <option
            value="{{ $item['value'] }}"
            {{ isset($item['selected']) && $item['selected'] ? 'selected' : '' }}
            {{ isset($item['disabled']) && $item['disabled'] ? 'disabled' : '' }}
        >
            {{ $item['value'] }}
        </option>
    @endforeach
</select>
@if($errors->get($name))
    <div class="form-error">{{ implode(', ', $errors->get($name)) }}</div>
@endif