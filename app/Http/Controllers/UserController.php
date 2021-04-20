<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class UserController extends Controller
{
	protected $userService;

	public function __construct(UserService $userService)
	{
        $this->userService = $userService;
	}
	
    public function create()
    {
		return view('pages.registration.index');
	}
	
	public function store(Request $request)
	{
		$this->validate($request, [
           	'phone' => 'required|unique:users',
           	'email' =>'required|unique:users',
           	'password' => 'required',
           	'passwordReply'=> 'required'
       	]);
       	
       	if($request->password != $request->passwordReply){
			return back()->with('password_reply_bad', 'Неверно повторили пароль!');
		}
       	
       	$data = $request->only([
            'email',
            'phone',
            'password'
        ]);
       	$data['password'] = Hash::make($data['password']);
       	$newUser = $this->userService->createUser($data);
       	\Auth::loginUsingId($newUser->id);
		return back()->with('success', 'Вы успешно зарегистрированы!');
	}
	
	public function login()
	{
		return view('pages.login.index');
	}
	
	public function auth(Request $request)
	{
		$this->validate($request, [
           	'phone' => 'required',
           	'password' => 'required',
       	]);
       	
		$data = $request->only([
            'phone',
            'password'
        ]);
        if(\Auth::attempt(['phone' => $request->phone, 'password' => $request->password])){
			return redirect()->route('index');
		} else {
			return back()->with('auth_fail', 'Неверный телефон или пароль');
		}
	}
	
	public function forgotPassword()
	{
		return view('pages.forgot-password.forgot-password');
	}
	
	public function forgotPasswordSend(Request $request)
	{
		$this->validate($request, ['email' => 'required|email']);

		$status = Password::sendResetLink(
			$request->only('email')
		);

		return $status === Password::RESET_LINK_SENT
					? back()->with(['status' => __($status)])
					: back()->withErrors(['email' => __($status)]);
	}
	
	public function resetPassword($token)
	{
		return view('pages.forgot-password.reset-password', ['token' => $token]);
	}
	
	public function resetPasswordSend(Request $request)
	{
		$this->validate($request,[
			'token' => 'required',
			'email' => 'required|email',
			'password' => 'required|min:8|confirmed',
		]);

		$status = Password::reset(
			$request->only('email', 'password', 'password_confirmation', 'token'),
			function ($user, $password) use ($request) {
				$user->forceFill([
					'password' => Hash::make($password)
				])->setRememberToken(Str::random(60));

				$user->save();

				event(new PasswordReset($user));
			}
		);

		return $status == Password::PASSWORD_RESET
					? redirect()->route('login')->with('status', __($status))
					: back()->withErrors(['email' => [__($status)]]);
	}
}
