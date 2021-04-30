<div class="form-group">
    <label>{{ $specification->title }}
        <select class="form-select" name="filter[props][{{ $specification->slug }}]">
            <option selected="selected">{{ __('catalog.not-selected') }}</option>
            @foreach($specificationsValues as $value)
                <option {{ $filtering && $filterValue === $value->value ? 'selected' : '' }}
                        value="{{ $value->value }}">{{ $value->value }}</option>
            @endforeach
        </select>
    </label>
</div>
