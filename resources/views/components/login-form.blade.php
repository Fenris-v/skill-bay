<form class="form Authorization" action="{{route('auth')}}" method="post">
	@csrf
	@include('includes.validate')
	@include('includes.auth_fail')
	<div class="row">
		<div class="row-block">
			<x-user-field data-validate="require" type="tel"  name="phone" title="{{__('user_messages.phone')}}" id="phone" placeholder="{{__('user_messages.phone')}}">{{__('user_messages.phone')}}</x-user-field>
			<x-user-field data-validate="require" type="password"  name="password" title="{{__('user_messages.password')}}" id="password" placeholder="{{__('user_messages.placeholder_password_login')}}">{{__('user_messages.password')}}</x-user-field>
			<div class="form-group">
				<button class="btn btn_primary" type="submit">{{__('user_messages.login')}}</button><a class="btn btn_primary" href="{{route('forgot-password')}}">{{__('user_messages.forgot_password')}}</a>
			</div>
		</div>
	</div>
</form>
