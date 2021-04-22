<?php

namespace App\Repository;

use App\Models\User;
use App\Models\Cart;
use App\Repository\ConfigRepository;
use Cache;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ProductRepository
 *
 * @author Roman Sarvarov <roman.sarvarov@gmail.com>
 */
class CartRepository
{
    private ConfigRepository $configRepository;
    private int $ttl;

    public function __construct()
    {
        $this->configRepository = app(ConfigRepository::class);
        $this->ttl = $this->configRepository->getCacheLifetime(now()->addDay());
    }

    /**
     * Возвращает корзину пользователя.
     *
     * @param  User  $user
     * @return Cart
     */
    public function getUserCart(User $user): Cart
    {
        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Cart::class,
        ])->remember(
            'cart_user|' . $user->id,
            $this->ttl,
            function () use ($user) {
                $cart = Cart
                    ::whereHas(
                        'user',
                        fn(Builder $query) => $query->where('id', $user->id)
                    )
                    ->doesntHave('order')
                    ->firstOrNew()
                    ->user()
                    ->associate($user)
                ;
                $cart->save();

                return $cart;
            }
        );
    }
}
