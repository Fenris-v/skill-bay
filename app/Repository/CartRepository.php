<?php

namespace App\Repository;

use App\Models\User;
use App\Models\Cart;
use App\Repository\ConfigRepository;
use Cache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

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
            fn() => Cart
                ::whereHas(
                    'user',
                    fn(Builder $query) => $query->where('id', $user->id)
                )
                ->doesntHave('order')
                ->firstOrCreate()
                ->associate($user)
        );
    }

    /**
     * Возвращает корзину неавторизованного пользователя.
     *
     * @param  string  $guest_id
     * @return Cart
     */
    public function getGuestCart(string $guest_id): Cart
    {
        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Cart::class,
        ])->remember(
            'cart_guest|' . $guest_id,
            $this->ttl,
            fn() => Cart::where('guest_id', $guest_id)
                ->doesntHave('order')
                ->firstOrNew()
        );
    }

    /**
     * Сливает корзину неавторизованного пользователя в корзину авторизованного
     *
     * @return Cart
     */
    public function mergeCarts(Cart $guestCart, Cart $userCart): Cart
    {
        $userCart->guest_id = $guestCart->guest_id;
        $userCart->products()->syncWithPivotValues(
            $userCart->products->merge($guestCart->products)
        );
        $guestCart->forceDelete();
        $userCart->save();

        return $userCart;
    }

    /**
     * Возвращает корзину
     *
     * @return Cart
     */
    public function getCart(): Cart
    {
        if (!session()->has('guest_id')) {
            session(['guest_id' => Str::uuid()]);
        }
        $guestCart = $this->getGuestCart(session('guest_id'));

        if (auth()->check()) {
            return $this->mergeCarts(
                $this->getUserCart(auth()->user()),
                $guestCart
            );
        } else {
            $guestCart->guest_id = session('guest_id');
            $guestCart->save();
            return $guestCart;
        }
    }
}
