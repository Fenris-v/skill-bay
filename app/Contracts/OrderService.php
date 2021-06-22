<?php


namespace App\Contracts;

use App\Http\Requests\OrderDeliveryRequest;
use App\Http\Requests\OrderPaymentRequest;
use App\Http\Requests\OrderPersonalRequest;
use App\Models\Order;
use App\Repository\CartRepository;

/**
 * Class OrderService
 *
 */
interface OrderService
{
    /**
     * Сохраняет в Order персональные данные пользователя (name, phone, email, user)
     *
     * @param  OrderPersonalRequest $request
     * @return Order
     */
    public function savePersonalDataToOrder(OrderPersonalRequest $request): Order;

    /**
     * Сохраняет в Order данные доставки
     *
     * @param  OrderDeliveryRequest $request
     * @return Order
     */
    public function saveDeliveryTypeToOrder(OrderDeliveryRequest $request): Order;

    /**
     * Сохраняет в Order данные о способе оплаты
     *
     * @param  OrderPaymentRequest $request
     * @return Order
     */
    public function savePaymentTypeToOrder(OrderPaymentRequest $request): Order;

    /**
     * Сохраняет в Order данные о корзине
     *
     * @param  CartRepository $cartRepository
     * @return bool
     */
    public function saveCartToOrder(CartRepository $cartRepository): bool;
}
