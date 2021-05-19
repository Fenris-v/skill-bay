<form action="{{route('logout')}}" method="post">
	@csrf
	{{auth()->user()->name}}&nbsp;/&nbsp;<button class="ControlPanel-title" type="submit" class="ControlPanel-title">{{__('user_messages.logout')}}</button>
</form>
