<form class="form Authorization" action="{{route('reset-password-send')}}" method="post">
	@csrf
	@if(count($errors) > 0)
		@foreach($errors->all() as $error)
			<div class="alert alert-danger errors">{{$error}}</div>
		@endforeach
	@endif
	@if ($message = Session::get('status'))
		<div class="alert alert-success">{{ $message }}</div>
	@endif
	<div class="row">
		<div class="row-block">
			<x-user-field type="email"  name="email" title="Email" id="email" placeholder="Email">Email</x-user-field>
			<x-user-field type="password"  name="password" title="password" id="password" placeholder="password">Password</x-user-field>
			<x-user-field type="email"  name="email" title="Email" id="email" placeholder="Email">Email</x-user-field>
			<input name="token" type="hidden" value="{{$token}}">
			<div class="form-group">
				<button class="btn btn_primary" type="submit">Сбросить пароль</button>
			</div>
		</div>
	</div>
</form>
