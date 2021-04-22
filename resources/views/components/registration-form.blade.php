<form class="form Authorization" action="{{route('user.store')}}" method="post">
	@csrf
	@include('includes.validate')
	<div class="row">		  
		<div class="row-block">
			<x-user-field type="tel"  name="phone" title="Телефон" id="phone" placeholder="+70000000000">Телефон</x-user-field>
			<x-user-field type="email"  name="mail" title="E-mail" id="mail" placeholder="send@test.test">E-mail</x-user-field>
			<x-user-field type="password"  name="password" title="Пароль" id="password" placeholder="Выберите пароль">Пароль</x-user-field>
			<x-user-field type="password"  name="passwordReply" title="Подтверждение пароля" id="passwordReply" placeholder="Введите пароль повторно">Подтверждение пароля</x-user-field>
			<div class="form-group">
				<button class="btn btn_primary" type="submit">Зарегистрироваться</button>
			</div>
		</div>      
	</div>
</form>
