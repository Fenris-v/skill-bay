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
                    ->with('products')
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
                ->with('products')
                ->doesntHave('order')
                ->firstOrNew()
        );
    }

    /**
     * Сливает корзину неавторизованного пользователя в корзину авторизованного
     *
     * @param Cart $guestCart
     * @param Cart $userCart
     * @return Cart
     */
    protected function mergeCarts(Cart $guestCart, Cart $userCart): Cart
    {
        if (!$guestCart->products->count()) {
            return $userCart;
        }

        $prepareCollection = fn($item) => [
            $item->id => [
                'seller_id' => $item->pivot->seller->id,
                'amount' => $item->pivot->amount,
            ]
        ];
        $userCart->guest_id = $guestCart->guest_id;
        $mergedCartProducts = $userCart->products->mapWithKeys($prepareCollection);

        foreach ($guestCart->products->mapWithKeys($prepareCollection) as $productKey => $guestCartProduct) {
            $mergedCartProducts[$productKey] = $guestCartProduct;
        }

        $userCart->products()->sync($mergedCartProducts);
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
     * Возвращает товары, находящиеся в корзине
     *
     * @return Collection|Product[]
     */
    public function getCartProducts(): Collection
    {
        $cart = $this->getCart();

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
     * Возвращает количество товаров в корзине
     *
     * @return int
     */
    public function getCartProductsCount(): int
    {
        $cart = $this->getCart();

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
     * Добавление товара в корзину.
     *
     * @param  Product $product
     * @param  int  $amount
     * @param Seller|null $seller
     * @return bool
     */
    public function add(
        Product $product,
        int  $amount,
        Seller $seller = null
    ): bool {
        $this->getCart()->products()
            ->attach(
                $product,
                [
                    'amount' => $amount,
                    'seller_id' => $seller->id ?? $product->sellers->random()->id,
                ]
            )
        ;

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
     * @param  int  $amount
     * @return bool
     */
    public function changeAmount(
        Product $product,
        int  $amount
    ): bool {
        if ($amount === 0) {
            return $this->remove($product);
        }
        $this->getCart()
            ->products()->updateExistingPivot($product->id, [
                'amount' => $amount,
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

    /**
     * Изменяет количество товара, а также его продавца в корзине.
     *
     * @param  Product $product
     * @param  Seller  $seller
     * @param int $amount
     * @return bool
     */
    public function changeSellerAndAmount(
        Product $product,
        Seller  $seller,
        int $amount
    ): bool {
        $this->getCart()
            ->products()->updateExistingPivot($product->id, [
                'seller_id' => $seller->id,
                'amount' => $amount,
            ]);

        return true;
    }
}
