<div class="form-group">
    <label>{{ $specification->title }}
        <select class="form-select" multiple size="4"
                name="filter[props][{{ $specification->slug }}][]">

            <option value="">{{ __('catalog.not-selected') }}</option>
            @foreach($specificationsValues as $value)
                <option {{ $filtering && in_array($value->value, $filterValue) ? 'selected' : '' }}
                        value="{{ $value->value }}">{{ $value->value }}</option>
            @endforeach
        </select>
    </label>
</div>
