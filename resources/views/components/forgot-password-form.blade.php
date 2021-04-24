<form class="form Authorization" action="{{route('forgot-password-send')}}" method="post">
	@csrf
	@include('includes.validate')
	@include('includes.validate_status')
	<div class="row">
		<div class="row-block">
			<x-user-field type="email"  name="email" title="Email" id="email" placeholder="Email">Email</x-user-field>
			<div class="form-group">
				<button class="btn btn_primary" type="submit">Сбросить пароль</button><button class="btn btn_primary"><a href="{{route('login')}}">Сбросить пароль</a></button>
			</div>
		</div>
	</div>
</form>
