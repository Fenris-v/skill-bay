<?php

namespace App\Repository;

use App\Contracts\OrderPaymentService as OrderPaymentServiceContract;
use App\Models\Cart;
use App\Models\DeliveryType;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Cache;

class OrdersRepository
{
    const PER_PAGE = 5;

    public function __construct(
        public OrderPaymentServiceContract $payment,
        public ConfigRepository $configs
    ) {}

    /**
     * Возвращает объект заказа
     * @param int $id
     * @return Model
     */
    public function getById(int $id): Model
    {
        return Order::with(
            [
                'user',
                'deliveryType',
                'paymentType',
                'cart' => function ($query) {
                    $this->cart($query);
                }
            ]
        )->find($id);
    }

    /**
     * Возвращает историю заказов пользователя
     * @param int $userId
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getByUserId(int $userId, int $limit = self::PER_PAGE): LengthAwarePaginator
    {
        return $this->query($userId)->paginate($limit);
    }

    /**
     * @param int $userId
     * @return Model|null
     */
    public function getLast(int $userId): ?Model
    {
        return $this->query($userId)->first();
    }

    /**
     * Возвращает статус оплаты заказа
     * @param Order $order
     * @return bool
     */
    public function getPaymentStatus(Order $order): bool
    {
        return $this->payment->isPaid($order);
    }

    /**
     * Запрашивает текст ошибки у сервиса и возвращает его
     * @param Order $order
     * @return string
     */
    public function getErrorMessage(Order $order): string
    {
        return $this->payment->getErrorMessage($order);
    }

    /**
     * Связь с продуктами в заказе
     * @param BelongsTo $query
     */
    private function cart(BelongsTo $query)
    {
        $query->with(
            [
                'products' => function ($query) {
                    $query->with(
                        [
                            'image',
                            'cart' => function ($query) {
                                $query->with('productSeller');
                            }
                        ]
                    );
                }
            ]
        );
    }

    private function query(int $userId)
    {
        return Order::with(['deliveryType', 'paymentType'])
            ->where('user_id', $userId)
            ->latest();
    }

    /**
     * Возвращает текущий (неоформленный) заказ.
     *
     * @return Order
     */
    public function getCurrentOrder()
    {
        $user = auth()->user();
        if (!$user) {
            return Order::make();
        }

        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Order::class,
            User::class
        ])->remember(
            'current_order_of_user_' . $user->id,
            $this->configs->getCacheLifetime(now()->addDay()),
            fn() => Order::whereHas(
                    'user',
                    fn(Builder $query) => $query->where('id', $user->id)
                )
                ->whereDoesntHave('cart')
                ->firstOrNew()
        );
    }

    /**
     * Сохраняет персональные данные пользователя.
     *
     * @param array $params
     * @param User $user
     * @return Order
     */
    public function savePersonal(array $params, User $user): Order
    {
        $order = $this->getCurrentOrder();
        $order->fill($params);
        $order->user()->associate($user);
        $order->save();

        Cache::tags([Order::class])->flush();

        return $order;
    }

    /**
     * Сохраняет данные доставки.
     *
     * @param array $params
     * @param DeliveryType $deliveryType
     * @return Order
     */
    public function saveDelivery(array $params, DeliveryType $deliveryType): Order
    {
        $order = $this->getCurrentOrder();
        $order->deliveryType()->associate($deliveryType);
        $order->update($params);

        Cache::tags([Order::class])->flush();

        return $order;
    }

    /**
     * Сохраняет способ оплаты.
     *
     * @param PaymentType $paymentType
     * @return Order
     */
    public function savePayment(PaymentType $paymentType): Order
    {
        $order = $this->getCurrentOrder();
        $order->paymentType()->associate($paymentType);
        $order->save();

        Cache::tags([Order::class])->flush();

        return $order;
    }

    /**
     * Окончательное оформление заказа
     *
     * @param  Cart  $cart
     * @throws \App\Exceptions\OrderPaymentException
     * @return bool
     */
    public function saveCart(Cart $cart): bool
    {
        $order = $this->getCurrentOrder();
        $order->cart()->associate($cart);
        $order->save();
        Cache::tags([Order::class, Cart::class])->flush();

        return $this->payment->pay($order);
    }
}
