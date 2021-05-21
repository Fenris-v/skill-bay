<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderDeliveryRequest;
use App\Http\Requests\OrderPaymentRequest;
use App\Http\Requests\OrderPersonalRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Repository\CartRepository;
use App\Repository\OrdersRepository;
use App\Services\AlertFlashService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct(
        protected AlertFlashService $alert,
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

    public function stepPersonalStore(OrderPersonalRequest $request, UserService $userService)
    {
        $order = $this->ordersRepository->getCurrentOrder();

        if (!auth()->check()) {
            $data = $request->only([
                'email',
                'phone',
                'password',
                'name'
            ]);
            $user = $userService->registerUser($data);
            $this->ordersRepository->getCurrentOrder(
                $request->only([
                    'email',
                    'phone',
                    'name'
                ])
            );
            Auth::login($user);
        } else {
            $user = auth()->user();
            $this->ordersRepository->getCurrentOrder(
                $request->only([
                    'email',
                    'phone',
                    'name'
                ])
            );
        }

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

    public function stepDeliveryStore(OrderDeliveryRequest $request)
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

public function stepPaymentStore(OrderPaymentRequest $request)
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

    public function stepAcceptStore(CartRepository $cartRepository) {
        if ($this->ordersRepository->saveAcceptStep($cartRepository->getCart())) {
            $result = 'success';
        } else {
            $result = 'error';
            $this->alert->warning();
        }

        $this->alert->lang('orderMessages.payment.' . $result);

        return redirect()->route('index');
    }
}
