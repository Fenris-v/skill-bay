<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Repository\UserRepository;
use App\Repository\OrdersRepository;
use App\Services\AlertFlashService;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function __construct(
        protected AlertFlashService $alert,
        protected UserRepository $userRepository,
        protected OrdersRepository $ordersRepository
    ) {}

    public function stepPersonal()
    {
        return view('pages.main.order', [
            'completedSteps' => [],
            'component' => 'order.personal',
            'order' => $this->ordersRepository->getCurrentOrder(),
        ]);
    }

    public function stepPersonalStore(Request $request)
    {
        $user = auth()->user()
            ?? $this->userRepository
                ->store($request->only([
                        'name',
                        'phone',
                        'email',
                        'password',
                        'password_confirmation'
                    ]
                ))
        ;
        $order = $this->ordersRepository->getCurrentOrder();
        $order->user()->associate($user);

        $order->save();

        return redirect(route('order.delivery.get'));
    }

    public function stepDelivery()
    {
        return view('pages.main.order', [
            'completedSteps' => ['personal'],
            'component' => 'order.delivery',
        ]);
    }

    public function stepDeliveryStore(Request $request)
    {
        $order = $this->ordersRepository->saveDeliveryStep($request->only([
            'city',
            'address',
            'delivery'
        ]));

        return redirect(route('order.payment.get'));
    }

    public function stepPayment()
    {
        return view('pages.main.order', [
            'completedSteps' => ['personal', 'delivery'],
            'component' => 'order.payment',
        ]);
    }

public function stepPaymentStore(Request $request)
{
    $this->ordersRepository->savePaymentStep($request->only([
        'payment'
    ]));

    return redirect(route('order.accept.get'));
}

    public function stepAccept()
    {
        return view('pages.main.order', [
            'completedSteps' => ['personal', 'delivery', 'payment'],
            'component' => 'order.accept',
        ]);
    }
}
