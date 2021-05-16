<?php

namespace App\Http\Controllers;

use App\Repository\OrdersRepository;
use Illuminate\Contracts\View\View;

class OrdersHistoryController extends Controller
{
    /**
     * @param OrdersRepository $orders
     * @return View
     */
    public function index(OrdersRepository $orders): View
    {
        $history = $orders->getByUserId(auth()->id());

        return view('pages.account.orders', compact('history'));
    }

    /**
     * @param OrdersRepository $orders
     * @param int $id
     * @return View
     */
    public function show(OrdersRepository $orders, int $id): View
    {
        $order = $orders->getById($id);

        abort_unless($order->user_id === auth()->id(), 403);

        return view('pages.account.order', compact('order'));
    }
}
