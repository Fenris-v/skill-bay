<?php

namespace App\Repository;

use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Image;
use App\Models\Seller;
use App\Repository\ConfigRepository;
use Cache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;

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
            function() use ($user) {
                $cart = Cart
                    ::whereHas(
                        'user',
                        fn(Builder $query) => $query->where('id', $user->id)
                    )
                    ->doesntHave('order')
                    ->firstOrNew()
                    ->user()->associate($user)
                ;
                if (!$cart->id) $cart->save();

                return $cart;
            }
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
        $prepareCollection = fn($item) => [
            'product|' . $item->id => [
                'seller_id' => $item->pivot->seller->id,
                'amount' => $item->pivot->amount,
            ]
        ];
        $userCart->guest_id = $guestCart->guest_id;
        $userCart->products()->sync(
            $userCart->products->mapWithKeys($prepareCollection)
                ->merge($guestCart->products->mapWithKeys($prepareCollection))
            ->mapWithKeys(fn($item, $key) => [
                str_replace('product|', '', $key) => [
                    'seller_id' => $item['seller_id'],
                    'amount' => $item['amount'],
                ]
            ])
        );
        $guestCart->forceDelete();
        Cache::tags([Cart::class])->flush();

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
                $guestCart,
                $this->getUserCart(auth()->user())
            );
        } else {
            $guestCart->guest_id = session('guest_id');
            $guestCart->save();
            return $guestCart;
        }
    }

    /**
     * Возвращает корзину
     *
     * @param Cart $cart
     * @return Collection|Product[]
     */
    public function getCartProducts(Cart $cart): Collection
    {
        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Cart::class,
            Product::class,
            Image::class,
            Seller::class,
        ])->remember(
            'cart|' . $cart->id . '|products',
            $this->ttl,
            fn() => $cart->products()->with([
                'sellers',
                'images',
            ])
            ->get()
        );
    }

    /**
     * Возвращает корзину
     *
     * @param Cart $cart
     * @return int
     */
    public function getCartProductsCount(Cart $cart): int
    {
        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Cart::class,
        ])->remember(
            'cart|' . $cart->id . '|products_count',
            $this->ttl,
            fn() => $cart->products()->count()
        );
    }

    /**
     * Возвращает корзину
     *
     * @param Cart $cart
     * @return array
     */
    public function getCartTotalPrice(Cart $cart): array
    {
        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Cart::class,
            Product::class,
            Seller::class,
        ])->remember(
            'cart|' . $cart->id . '|total_price',
            $this->ttl,
            fn() => $cart
                ->products
                ->reduce(
                    fn($accum, $product) => [
                        'current' => $accum['current'] + $product->currentPrice,
                        'old' => $accum['old'] + $product->averagePrice,
                    ], [
                        'current' => 0, 'old' => 0
                    ]
                )
        );
    }

    /**
     * Добавление товара в корзину.
     *
     * @param  Product $product
     * @param  array  $data
     * @return bool
     */
    public function add(
        Product $product,
        array $data
    ): bool {
        $cart = $this->getCart();

        if ($cart->products->contains(fn($productInCart) => $productInCart->slug === $product->slug)) {
            return $this->changeAmount($product, $data);
        } else {
            $cart->products()
                ->attach(
                    $product,
                    [
                        'amount' => $data['amount'],
                        'seller_id' => $product->sellers->random()->id,
                    ]
                )
            ;
        }

        return true;
    }

    /**
     * Удаление товара из корзины.
     *
     * @param  Product $product
     * @return bool
     */
    public function remove(Product $product): bool
    {
        $this->getCart()
            ->products()->detach($product)
        ;

        return true;
    }

    /**
     * Изменяет количество товара в корзине.
     *
     * @param  Product $product
     * @param  array  $data
     * @return bool
     */
    public function changeAmount(Product $product, array $data): bool
    {
        if ($data['amount'] == 0) return $this->remove($product);

        $this->getCart()
            ->products()->updateExistingPivot($product->id, [
                'amount' => $data['amount'],
            ]);

        return true;
    }

    /**
     * Изменяет количество товара в корзине.
     *
     * @param  Product $product
     * @param  Seller  $seller
     * @return bool
     */
    public function changeSeller(
        Product $product,
        Seller  $seller
    ): bool {
        $this->getCart()
            ->products()->updateExistingPivot($product->id, [
                'seller_id' => $seller->id,
            ]);

        return true;
    }
}
