<div class="form-group">
    <select class="form-select" name="filter[props][{{ $specification->slug }}]">
        <option selected="selected"
                disabled="disabled">{{ $specification->title }}</option>
        <option value="">{{ __('catalog.not-selected') }}</option>
        @foreach($specificationsValues as $value)
            <option {{ $filtering && $filterValue === $value->value ? 'selected' : '' }}
                    value="{{ $value->value }}">{{ $value->value }}</option>
        @endforeach
    </select>
</div>
