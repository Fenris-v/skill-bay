<form action="{{route('logout')}}" method="post">
	@csrf
	<button class="btn btn_primary" type="submit" class="ControlPanel-title">{{__('user_messages.logout')}}</button>
</form>
