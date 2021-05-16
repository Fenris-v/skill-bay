<?php

namespace App\Http\Controllers;

use App\Repository\OrdersRepository;
use App\Repository\ProductViewHistoryRepository;
use App\Repository\UserRepository;
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
        UserRepository $users,
        ProductViewHistoryRepository $historyRepository
    ): View {
        $userId = auth()->id();

        $order = $orders->getLast($userId);

        $user = $users->getById($userId, ['name']);

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
        return view('pages.account.profile');
    }
}
