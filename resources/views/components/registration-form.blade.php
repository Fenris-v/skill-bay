<form class="form Authorization" action="{{route('user.store')}}" method="post">
	@csrf
	@include('includes.validate')
	<div class="row">		  
		<div class="row-block">
			<x-user-field type="tel"  name="phone" title="{{__('user_messages.phone')}}" id="phone" placeholder="+70000000000">{{__('user_messages.phone')}}</x-user-field>
			<x-user-field type="email"  name="mail" title="{{__('user_messages.email')}}" id="mail" placeholder="send@test.test">{{__('user_messages.email')}}</x-user-field>
			<x-user-field type="password"  name="password" title="{{__('user_messages.password')}}" id="password" placeholder="Выберите пароль">{{__('user_messages.password')}}</x-user-field>
			<x-user-field type="password"  name="passwordReply" title="{{__('user_messages.password_confirm')}}" id="passwordReply" placeholder="Введите пароль повторно">{{__('user_messages.password_confirm')}}</x-user-field>
			<div class="form-group">
				<button class="btn btn_primary" type="submit">{{__('user_messages.register')}}</button>
			</div>
		</div>      
	</div>
</form>
