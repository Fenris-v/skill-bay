@props(['name' => null, 'label' => null])
<div class="form-group">
    @if($label)
        <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    @endif
    {{ $slot }}
    @if($errors->get($name))
        <div class="form-error">{{ implode(', ', $errors->get($name)) }}</div>
    @endif
</div>