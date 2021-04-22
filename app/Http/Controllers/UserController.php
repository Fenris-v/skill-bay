<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Http\Requests\{StoreUserRequest, AuthRequest, ForgotPasswordRequest, ResetPasswordRequest};

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
	
	public function store(StoreUserRequest $request)
	{       	
       	$data = $request->only([
            'email',
            'phone',
            'password'
        ]);
       	$newUser = $this->userService->createUser($data);
       	\Auth::loginUsingId($newUser->id);
		return back()->with('success', __('user_messages.registration_success'));
	}
	
	public function login()
	{
		return view('pages.login.index');
	}
	
	public function auth(AuthRequest $request)
	{    	
		$data = $request->only([
            'phone',
            'password'
        ]);
        if(\Auth::attempt($data)){
			return redirect()->route('index');
		} else {
			return back()->with('auth_fail', __('user_messages.auth_fail'));
		}
	}
	
	public function forgotPassword()
	{
		return view('pages.forgot-password.forgot-password');
	}
	
	public function forgotPasswordSend(ForgotPasswordRequest $request)
	{
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
	
	public function resetPasswordSend(ResetPasswordRequest $request)
	{
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
