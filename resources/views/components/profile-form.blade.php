<form action="{{route('profile.avatar.delete')}}" method="post">
	@method("DELETE")
	@csrf
	<button class="btn" type="submit">Удалить аватар</button>
</form>
<form class="form Profile-form" action="{{route('profile.edit')}}" method="post" enctype="multipart/form-data">
	@csrf
	@method("PUT")
	<div class="row">
		<div class="row-block">
			<div class="form-group">
				<label class="form-label" for="avatar">Аватар
				</label>
				<div class="Profile-avatar Profile-avatar_noimg">
					<div @if($user->attachment != null) style="display:block;" @endif class="Profile-img">@if($user->attachment != null) <img width="200" style="z-index:2;position: relative;" src="{{$user->attachment->name}}" alt="avatar"/>@else <img src="" alt="avatar"/> @endif
					</div>
					<label class="Profile-fileLabel" for="avatar">Выберите аватар
					</label>
					<input class="Profile-file form-input" id="avatar" name="avatar" type="file" data-validate="onlyImgAvatar"/>
				</div>
			</div>
			<x-user-field data-validate="require" type="text"  name="name" title="{{__('user_messages.name')}}" id="name" placeholder="{{__('user_messages.name')}}" value="{{old('name', $user->name)}}">{{__('user_messages.name')}}</x-user-field>
		</div>
		<div class="row-block">
			<x-user-field data-validate="require" type="tel"  name="phone" title="{{__('user_messages.phone')}}" id="phone" placeholder="{{__('user_messages.placeholder_phone')}}" value="{{old('phone', $user->phone)}}">{{__('user_messages.phone')}}</x-user-field>
			<x-user-field type="email"  name="email" title="{{__('user_messages.email')}}" id="mail" placeholder="{{__('user_messages.placeholder_mail')}}" value="{{old('email',$user->email)}}">{{__('user_messages.email')}}</x-user-field>
			<x-user-field type="password"  name="password" title="{{__('user_messages.password')}}" id="password" placeholder="{{__('user_messages.placeholder_password')}}">{{__('user_messages.password')}}</x-user-field>
			<x-user-field type="password"  name="password_confirmation" title="{{__('user_messages.placeholder_password_reply')}}" id="passwordReply" placeholder="{{__('user_messages.placeholder_password_reply')}}">{{__('user_messages.password_confirm')}}</x-user-field>
			<div class="form-group">
				<div class="Profile-btn">
					<button class="btn btn_success" type="submit">Сохранить</button>
				</div>
				@if ($message = Session::get('success'))
					<div class="Profile-success">{{$message}}</div>
				@endif
			</div>
		</div>
	</div>
</form>
