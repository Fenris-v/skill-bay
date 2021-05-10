<?php

namespace App\Repository;

use App\Models\DeliveryType;
use App\Models\Order;
use App\Models\PaymentType;
use App\Repository\ConfigRepository;
use Cache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class OrderRepository
{
    private ConfigRepository $configRepository;
    private int $ttl;

    public function __construct()
    {
        $this->configRepository = app(ConfigRepository::class);
        $this->ttl = $this->configRepository->getCacheLifetime(now()->addDay());
    }

    /**
     * Осуществляет валидацию пользовательского ввода
     *
     * @param array $values
     * @param array $rules
     * @return bool
     */
    protected function validate(array $values, array $rules)
    {
        Validator::make(
            $values,
            $rules
        )
            ->validate()
        ;
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
            Order::class
        ])->remember(
            'current_order_of_user_' . $user->id,
            $this->ttl,
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
    public function saveDeliveryStep(array $input): Order
    {
        $this->validate($input, [
            'city' => 'required|min:3|max:255',
            'address' => 'required|min:3|max:255',
            'delivery' => 'required|numeric',
        ]);
        $order = $this->getCurrentOrder();
        $order->deliveryType()->associate(DeliveryType::where('id', $input['delivery'])->firstOrFail());
        $order->update(collect($input)->only(['city', 'address'])->toArray());

        return $order;
    }

    /**
     * Возвращает данные оплаты.
     *
     * @param array $input
     * @return Order
     */
    public function savePaymentStep(array $input): Order
    {
        $this->validate($input, [
            'payment' => 'required|numeric',
        ]);
        $order = $this->getCurrentOrder();
        $order->paymentType()->associate(PaymentType::where('id', $input['payment'])->firstOrFail());
        $order->save();

        return $order;
    }
}
