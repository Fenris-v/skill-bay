<div class="form-group">
	<label class="form-label" for="{{$attributes->get('id')}}">{{ $slot }}</label>
	<input {{ $attributes }} class="form-input" data-validate="require">
</div>

