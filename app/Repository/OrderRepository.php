<?php

namespace App\Repository;

use App\Models\Order;
use App\Repository\ConfigRepository;
use Cache;
use Illuminate\Database\Eloquent\Builder;

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
     * Возвращает текущий (неоформленный) заказ.
     *
     * @return Order
     */
    public function getCurrentOrder()
    {
        $user = auth()->user();
        if ($user) {
            return new Order;
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
                ->first()
        );
    }
}
