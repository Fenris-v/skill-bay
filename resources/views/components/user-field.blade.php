<div class="form-group">
	<label class="form-label" for="{{$attributes->get('id')}}">{{ $slot }}</label>
	<input {{ $attributes }} class="form-input @if(!empty($errors->first($attributes->get('name')))) form-input_error @endif" data-validate="require" value="{{ old($attributes->get('name')) }}">
	@if(!empty($errors->first($attributes->get('name'))))
		<div class="form-error">{{$errors->first($attributes->get('name'))}}</div>
	@endif
</div>
