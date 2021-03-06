@props(['token'])
<form class="form Authorization" action="{{route('reset-password-send')}}" method="post">
	@csrf
	@include('includes.validate')
	@include('includes.validate_status')
	<div class="row">
		<div class="row-block">
			<x-user-field data-validate="require" type="email"  name="email" title="{{__('user_messages.email')}}" id="email" placeholder="{{__('user_messages.placeholder_mail')}}">{{__('user_messages.email')}}</x-user-field>
			<x-user-field data-validate="require" type="password"  name="password" title="{{__('user_messages.password')}}" id="password" placeholder="{{__('user_messages.placeholder_password')}}">{{__('user_messages.password')}}</x-user-field>
			<x-user-field data-validate="require" type="password"  name="password_confirmation" title="{{__('user_messages.password_confirm')}}" id="password_confirmation" placeholder="{{__('user_messages.placeholder_password_reply')}}">{{__('user_messages.password_confirm')}}</x-user-field>
			<input name="token" type="hidden" value="{{$token}}">
			<div class="form-group">
				<button class="btn btn_primary" type="submit">{{__('user_messages.reset_password')}}</button>
			</div>
		</div>
	</div>
</form>
