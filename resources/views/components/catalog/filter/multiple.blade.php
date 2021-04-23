<div class="form-group">
    <select class="form-select" multiple size="4"
            name="filter[props][{{ $specification->slug }}][]">
        <option disabled="disabled">{{ $specification->title }}</option>
        <option value="">{{ __('catalog.not-selected') }}</option>
        @foreach($specificationsValues as $value)
            <option
                    {{ $filtering && in_array($value, $filterValue) ? 'selected' : '' }}
                    value="{{ $value->value }}">{{ $value->value }}</option>
        @endforeach
    </select>
</div>
