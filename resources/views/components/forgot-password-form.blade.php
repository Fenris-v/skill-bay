<form class="form Authorization" action="{{route('forgot-password-send')}}" method="post">
	@csrf
	@include('includes.validate')
	@include('includes.validate_status')
	<div class="row">
		<div class="row-block">
			<x-user-field type="email"  name="email" title="{{__('user_messages.email')}}" id="email" placeholder="__('user_messages.placeholder_mail')">__('user_messages.email')</x-user-field>
			<div class="form-group">
				<button class="btn btn_primary" type="submit">{{__('user_messages.reset_password')}}</button><a class="btn btn_primary" href="{{route('login')}}">{{__('user_messages.login')}}</a>
			</div>
		</div>
	</div>
</form>
