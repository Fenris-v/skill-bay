<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderDeliveryRequest;
use App\Http\Requests\OrderPaymentRequest;
use App\Http\Requests\OrderPersonalRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Order;
use App\Repository\CartRepository;
use App\Repository\OrdersRepository;
use App\Services\AlertFlashService;
use App\Services\OrderService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Cache;

class OrderController extends Controller
{
    public function __construct(
        protected AlertFlashService $alert,
        protected OrdersRepository $ordersRepository,
        protected OrderService $orderService
    ) {}

    protected function isEnoughProgress(array $needSteps): bool
    {
        return collect($needSteps)->intersect($this->getProgress())->toArray() === $needSteps;
    }

    protected function getProgress()
    {
        $order = $this->ordersRepository->getCurrentOrder();
        $completedSteps = [];

        if ($order->user_id) {
            $completedSteps[] = 'personal';
        }
        if ($order->delivery_type_id) {
            $completedSteps[] = 'delivery';
        }
        if ($order->payment_type_id) {
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

    public function stepPersonalStore(
        OrderPersonalRequest $request,
        UserService $userService
    ) {
        if (!auth()->check()) {
            $user = $userService->registerUser($request->only([
                'email',
                'phone',
                'name',
                'password',
            ]));
            Auth::login($user);
        }

        $this->orderService->savePersonalDataToOrder($request);

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
        $this->orderService->saveDeliveryTypeToOrder($request);

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
    $this->orderService->savePaymentTypeToOrder($request);

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
        if (!$this->isEnoughProgress(['personal', 'delivery', 'payment'])) {
            $this->alert->danger();
            $this->alert->lang('orderMessages.notEnoughProgress');
            return back();
        }

        if ($this->orderService->saveCartToOrder($cartRepository)) {
            $result = 'success';
        } else {
            $result = 'error';
            $this->alert->warning();
        }

        $this->alert->lang('orderMessages.payment.' . $result);

        return redirect()->route('index');
    }
}
