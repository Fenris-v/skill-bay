<?php

namespace App\Http\Controllers;

use App\Repository\OrdersRepository;
use App\Repository\ProductViewHistoryRepository;
use App\Repository\EloquentUserRepository;
use Illuminate\Contracts\View\View;

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
    
    public function editProfile()
    {
		/*$path = $request->file('avatar')->storeAs(
			'avatars', $request->user()->id
		);*/
	}
}
