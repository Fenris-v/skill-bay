<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

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
}
