<div class="form-group">
    <label class="toggle">
        <input {{ isset(request()->get('filter')['props'][$specification->slug]) ? 'checked' : '' }}
                name="filter[props][{{ $specification->slug }}]" type="checkbox"/>
        <span class="toggle-box"></span>
        <span class="toggle-text">{{ $specification->title }}</span>
    </label>
</div>
