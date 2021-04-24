<form class="form Authorization" action="{{route('reset-password-send')}}" method="post">
	@csrf
	@include('includes.validate')
	@include('includes.validate_status')
	<div class="row">
		<div class="row-block">
			<x-user-field type="email"  name="email" title="Email" id="email" placeholder="Email">Email</x-user-field>
			<x-user-field type="password"  name="password" title="password" id="password" placeholder="password">Password</x-user-field>
			<x-user-field type="password"  name="password_confirmation" title="password confirmation" id="password_confirmation" placeholder="password confirmation">Confirm password</x-user-field>
			<input name="token" type="hidden" value="{{$token}}">
			<div class="form-group">
				<button class="btn btn_primary" type="submit">Сбросить пароль</button>
			</div>
		</div>
	</div>
</form>
