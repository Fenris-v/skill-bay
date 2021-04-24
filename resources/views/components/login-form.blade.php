<form class="form Authorization" action="{{route('auth')}}" method="post">
	@csrf
	@include('includes.validate')
	@if ($message = Session::get('auth_fail'))
		<div class="alert alert-danger errors">{{ $message }}</div>
	@endif
	<div class="row">
		<div class="row-block">
			<x-user-field type="tel"  name="phone" title="Телефон" id="phone" placeholder="+70000000000">Телефон</x-user-field>
			<x-user-field type="password"  name="password" title="Пароль" id="password" placeholder="Выберите пароль">Пароль</x-user-field>
			<div class="form-group">
				<button class="btn btn_primary" type="submit">Войти</button>
			</div>
		</div>
	</div>
</form>
