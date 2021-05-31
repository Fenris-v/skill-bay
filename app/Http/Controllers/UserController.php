<?php

namespace App\Http\Controllers;

use App\Http\Requests\{AuthRequest, ForgotPasswordRequest, RegisterUserRequest, ResetPasswordRequest};
use App\Services\UserService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    protected function doAuth(AuthRequest $request): bool
    {
        $data = $request->only(
            [
                'phone',
                'password'
            ]
        );
        return Auth::attempt($data);
    }

    public function create()
    {
        return view('pages.registration.index');
    }

    public function store(RegisterUserRequest $request)
    {
        $data = $request->only(
            [
                'email',
                'phone',
                'password'
            ]
        );
        $newUser = $this->userService->registerUser($data);
        Auth::loginUsingId($newUser->id);
        return back()->with('success', __('user_messages.registration_success'));
    }

    public function login()
    {
        return view('pages.login.index');
    }

    public function auth(AuthRequest $request)
    {
        if ($this->doAuth($request)) {
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
                $user->forceFill(
                    [
                        'password' => Hash::make($password)
                    ]
                )->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function logout()
    {
        Auth::logout();
        return back();
    }

    public function loginForOrder()
    {
        return view('pages.login.index');
    }

    public function authAndBackToOrder(AuthRequest $request)
    {
        if ($this->doAuth($request)) {
            return redirect()->route('order.personal.get');
        } else {
            return back()->with('auth_fail', __('user_messages.auth_fail'));
        }
    }
}
