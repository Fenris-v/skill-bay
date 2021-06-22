<?php

namespace App\Services;

use App\Contracts\OrderService as OrderServiceInterface;
use App\Http\Requests\OrderDeliveryRequest;
use App\Http\Requests\OrderPaymentRequest;
use App\Http\Requests\OrderPersonalRequest;
use App\Models\Order;
use App\Models\DeliveryType;
use App\Models\PaymentType;
use App\Repository\CartRepository;
use App\Repository\OrdersRepository;


class OrderService implements OrderServiceInterface
{
    public function __construct(
        protected OrdersRepository $ordersRepository,
        protected UserService $userService
    ) {}

    /**
     * Сохраняет в Order персональные данные пользователя (name, phone, email, user)
     *
     * @param  OrderPersonalRequest $request
     * @return Order
     */
    public function savePersonalDataToOrder(OrderPersonalRequest $request): Order
    {

        $user = auth()->user();
        $order = $this->ordersRepository
            ->savePersonal(
                $request->only(['name', 'phone', 'email']),
                $user
            )
        ;

        if (!$user->name) {
            $this->userService->updateUser(
                [
                    'name' => $order->name,
                ],
                $user->id,
            );
        }

        return $order;
    }

    /**
     * Сохраняет в Order данные доставки
     *
     * @param  OrderDeliveryRequest $request
     * @return Order
     */
    public function saveDeliveryTypeToOrder(OrderDeliveryRequest $request): Order
    {
        return $this->ordersRepository->saveDelivery(
            $request->only(['city', 'address']),
            DeliveryType::where('id', $request['delivery'])->firstOrFail()
        );
    }

    /**
     * Сохраняет в Order данные о способе оплаты
     *
     * @param  OrderPaymentRequest $request
     * @return Order
     */
    public function savePaymentTypeToOrder(OrderPaymentRequest $request): Order
    {
        return $this->ordersRepository->savePayment(
            PaymentType::where('id', $request->payment)->firstOrFail()
        );
    }

    /**
     * Сохраняет в Order данные о корзине
     *
     * @param  CartRepository  $cartRepository
     * @param  Order|null  $order
     * @throws \App\Exceptions\OrderPaymentException
     * @return bool
     */
    public function saveCartToOrder(CartRepository $cartRepository, Order $order = null): bool
    {
        return $this->ordersRepository->saveCart(
            $order->cart ?? $cartRepository->getCart(), $order
        );
    }
}
