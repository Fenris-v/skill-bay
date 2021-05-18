{{--Шаблон ссылок на авторизацию--}}
<div class="row ControlPanel-rowSplit">
    <div class="row-block">
		@auth
		<x-logout-form/>
		@endauth
		@guest
        <a class="ControlPanel-title" href="{{route('login')}}">{{__('user_messages.login')}}</a>&nbsp;/&nbsp;
        <a class="ControlPanel-title" href="{{route('registration')}}">{{__('user_messages.registation')}}</a>
		@endguest
    </div>
</div>
