<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use App\Repository\OrderRepository;
use App\Services\AlertFlashService;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function __construct(
        protected AlertFlashService $alert,
        protected UserRepository $userRepository,
        protected OrderRepository $orderRepository
    ) {}

    public function stepPersonal()
    {
        return view('pages.main.order', [
            'completedSteps' => [],
            'component' => 'order.personal',
            'order' => $this->orderRepository->getCurrentOrder(),
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
        $order = $this->orderRepository->getCurrentOrder();
        $order->user()->associate($user);
        $order->save();

        return redirect(route('order.delivery.get'));
    }

    public function stepDelivery()
    {
        if (auth()->guest()) {
            return redirect(route('order.personal.get'));
        }
        return view('pages.main.order', [
            'completedSteps' => ['personal'],
            'component' => 'order.delivery',
        ]);
    }

    public function stepDeliveryStore(Request $request)
    {
        if (auth()->guest()) {
            return redirect(route('order.personal.get'));
        }

        $this->orderRepository->saveDeliveryStep($request->only([
            'city',
            'address',
            'delivery'
        ]));

        return redirect(route('order.payment.get'));
    }

    public function stepPayment()
    {
        if (auth()->guest()) {
            return redirect(route('order.personal.get'));
        }

        return view('pages.main.order', [
            'completedSteps' => ['personal', 'delivery'],
            'component' => 'order.payment',
        ]);
    }

public function stepPaymentStore(Request $request)
{
    if (auth()->guest()) {
        return redirect(route('order.personal.get'));
    }

    $this->orderRepository->savePaymentStep($request->only([
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
