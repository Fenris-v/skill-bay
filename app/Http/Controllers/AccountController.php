<?php

namespace App\Http\Controllers;

use App\Repository\OrdersRepository;
use App\Repository\ProductViewHistoryRepository;
use App\Repository\EloquentUserRepository;
use Illuminate\Contracts\View\View;
use App\Http\Requests\AccountRequest;
use Illuminate\Support\Facades\Hash;
use App\Services\UserService;

class AccountController extends Controller
{
    /**
     * @param OrdersRepository $orders
     * @param UserRepository $users
     * @param ProductViewHistoryRepository $historyRepository
     * @return View
     */
    public function index(
        OrdersRepository $orders,
        EloquentUserRepository $usersRepository,
        ProductViewHistoryRepository $historyRepository
    ): View {
        $userId = auth()->id();

        $order = $orders->getLast($userId);

        $user = $usersRepository->getById($userId, ['name']);

        $history = $historyRepository->get($userId, 3);

        return view(
            'pages.account.account',
            compact('order', 'user', 'history')
        );
    }

    /**
     * @return View
     */
    public function show(): View
    {
		$user = auth()->user();
        return view('pages.account.profile',["user" => $user]);
    }
    
    public function editProfile(AccountRequest $request, UserService $userService)
    {
		/*$path = $request->file('avatar')->storeAs(
			'avatars', $request->user()->id
        );*/
        $userId = auth()->user()->id;
        $data = [];
        $data["name"] = $request->name;
        $data["phone"] = $request->phone;
        $data["email"] = $request->email;

        if(!empty($request->password)){
            if($request->password == $request->password_confirmation){
                $data["password"] = Hash::make($request->password);
            } else {
                back()->withErrors("password",__('validation.confirmed'));
            }
        }
        $userService->updateUser($data, $userId);
        return back()->with('success', __('user_messages.profile_edit_success'));
	}
}
