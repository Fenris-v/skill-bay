<?php

namespace App\Repository;

use App\Models\Cart;
use App\Models\DeliveryType;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\User;
use App\Services\OrderPaymentService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Validator;
use Cache;

class OrdersRepository
{
    const PER_PAGE = 5;

    public function __construct(public OrderPaymentService $payment, public ConfigRepository $configs)
    {
    }

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
            fn() => Order
                ::whereHas(
                    'user',
                    fn(Builder $query) => $query->where('id', $user->id)
                )
                ->whereDoesntHave('cart')
                ->firstOrNew()
        );
    }

    /**
     * Сохраняет данные доставки.
     *
     * @param array $input
     * @return Order
     */
    public function savePersonalStep(array $input): Order
    {
        $this->getCurrentOrder()->update($input);

        Cache::tags([Order::class])->flush();

        return $order;
    }

    /**
     * Сохраняет данные доставки.
     *
     * @param array $input
     * @return Order
     */
    public function saveDeliveryStep(array $input): Order
    {
        $order = $this->getCurrentOrder();
        $order->deliveryType()->associate(DeliveryType::where('id', $input['delivery'])->firstOrFail());
        $order->update(collect($input)->only(['city', 'address'])->toArray());

        Cache::tags([Order::class])->flush();

        return $order;
    }

    /**
     * Сохраняет способ оплаты.
     *
     * @param array $input
     * @return Order
     */
    public function savePaymentStep(array $input): Order
    {
        $order = $this->getCurrentOrder();
        $order->paymentType()->associate(PaymentType::where('id', $input['payment'])->firstOrFail());
        $order->save();

        Cache::tags([Order::class])->flush();

        return $order;
    }

    /**
     * Окончательное оформление заказа
     *
     * @param Cart $cart
     * @return bool
     */
    public function saveAcceptStep(Cart $cart): bool
    {
        $order = $this->getCurrentOrder();
        $order->cart()->associate($cart);
        $order->save();
        Cache::tags([Order::class, Cart::class])->flush();

        return $this->payment->pay($order);
    }
}
