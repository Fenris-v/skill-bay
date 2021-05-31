@if ($message = Session::get('status'))
	<div class="alert alert-success">{{ $message }}</div>
@endif
