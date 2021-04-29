{{--Шаблон ссылок на авторизацию--}}
<div class="row ControlPanel-rowSplit">
    <div class="row-block">
		@auth
		<a class="ControlPanel-title" href="{{route('logout')}}">Выйти</a>
		@endauth
		@guest
        <a class="ControlPanel-title" href="{{route('registration')}}">Войти</a>&nbsp;/&nbsp;
        <a class="ControlPanel-title" href="{{route('login')}}">Регистрация</a>
		@endguest
    </div>
</div>
