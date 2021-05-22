<?php

namespace App\Services;

use App\Contracts\OrderService as OrderServiceInterface;
use App\Models\Order;
use App\Repository\OrdersRepository;


class OrderService implements OrderServiceInterface
{
    public function __construct(
        public OrdersRepository $ordersRepository
    ) {}

    /**
     * Сохраняет в Order персональные данные пользователя (name, phone, email)
     *
     * @param  array  $params
     * @return Order
     */
    public function addUserPersonalDataToOrder(array $params): Order
    {
        $order = $this->ordersRepository->getCurrentOrder();
        $order->fill(collect($params)->only(['phone', 'email', 'name'])->toArray());

        return $order;
    }
}
