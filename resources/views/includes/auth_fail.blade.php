@if ($message = Session::get('auth_fail'))
	<div class="alert alert-danger errors">{{ $message }}</div>
@endif
