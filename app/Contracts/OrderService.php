<?php


namespace App\Contracts;

use App\Models\Order;
use App\Models\User;

/**
 * Class OrderService
 *
 */
interface OrderService
{
    /**
     * Сохраняет в Order персональные данные пользователя (name, phone, email)
     *
     * @param  array  $params
     * @return Order
     */
    public function addUserPersonalDataToOrder(array $params): Order;
}
