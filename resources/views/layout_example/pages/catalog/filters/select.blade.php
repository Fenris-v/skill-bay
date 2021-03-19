<!--Выпадающий список-->
@php
    $sellers = [
            'Kkkk',
            'sdfsdf',
        ];
@endphp

<!-- - var options = setOptions(items, ['value', 'selected', 'disabled']);-->
<select class="form-select">
    <option value="seller" selected="selected" disabled="disabled">Продавец</option>

    @foreach($sellers as $seller)
        <option value="{{ $seller }}">{{ $seller }}</option>
    @endforeach
</select>
