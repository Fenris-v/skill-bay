<?php

namespace App\Http\Controllers;

use App\Repository\CartRepository;
use App\Repository\UserRepository;
use App\Repository\OrdersRepository;
use App\Services\AlertFlashService;
use App\Services\OrderPaymentService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        protected AlertFlashService $alert,
        protected UserRepository $userRepository,
        protected OrdersRepository $ordersRepository
    ) {}

    protected function getProgress()
    {
        $order = $this->ordersRepository->getCurrentOrder();
        $completedSteps = [];

        if ($order->user) {
            $completedSteps[] = 'personal';
        }
        if ($order->deliveryType) {
            $completedSteps[] = 'delivery';
        }
        if ($order->paymentType) {
            $completedSteps[] = 'payment';
        }

        return $completedSteps;
    }

    public function stepPersonal()
    {
        return view('pages.main.order', [
            'completedSteps' => $this->getProgress(),
            'component' => 'order.personal',
            'order' => $this->ordersRepository->getCurrentOrder(),
        ]);
    }

    public function stepPersonalStore(Request $request)
    {
        $order = $this->ordersRepository->getCurrentOrder();
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
        $order->user()->associate($user);

        $order->save();

        return redirect(route('order.delivery.get'));
    }

    public function stepDelivery()
    {
        return view('pages.main.order', [
            'completedSteps' => $this->getProgress(),
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
            'completedSteps' => $this->getProgress(),
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
            'completedSteps' => $this->getProgress(),
            'component' => 'order.accept',
        ]);
    }

    public function stepAcceptStore(
        CartRepository $cartRepository,
        OrderPaymentService $orderPaymentService
    ) {
        $order = $this->ordersRepository->getCurrentOrder();
        $order->cart()->associate($cartRepository->getCart());
        if ($orderPaymentService->pay($order)) {
            $result = 'success';
            $this->alert->warning();
        }

        $this->alert->lang('orderMessages.payment.' . $result);

        return redirect()->route('index');
    }
}
