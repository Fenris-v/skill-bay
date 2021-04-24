@props(['items'])
<select {{ $attributes->merge(['class' => 'form-select']) }}>
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