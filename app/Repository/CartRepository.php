<?php

namespace App\Repository;

use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Seller;
use App\Repository\ConfigRepository;
use Cache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\TimeToLiveCacheTrait;

class CartRepository
{
    use TimeToLiveCacheTrait;

    public function __construct(private ConfigRepository $configRepository)
    {}

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
            $this->ttl(),
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
     * @param string $guest_id
     * @return Cart
     */
    public function getGuestCart(string $guest_id): Cart
    {
        $cart = Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Cart::class,
        ])->remember(
            'cart_guest|' . $guest_id,
            $this->ttl(),
            fn() => Cart::where('guest_id', $guest_id)
                ->with('products')
                ->doesntHave('order')
                ->firstOrNew()
        );

        if (!$cart->guest_id) {
            session(['guest_id' => Str::uuid()]);
            $cart->guest_id = session('guest_id');
        }

        return $cart;
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
        $mergedCartProducts = $userCart->products->mapWithKeys($prepareCollection);
        foreach ($guestCart->products->mapWithKeys($prepareCollection) as $productKey => $guestCartProduct) {
            $mergedCartProducts[$productKey] = $guestCartProduct;
        }
        $userCart->products()->sync($mergedCartProducts->toArray());

        if ($guestCart->id) {
            $guestCart->forceDelete();
        }
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
            $this->ttl(),
            fn() => Product::with(['sellers'])
                ->join('cart_product_seller', fn ($join) =>
                    $join->on('products.id', '=', 'cart_product_seller.product_id')
                        ->where('cart_product_seller.cart_id', '=', $cart->id)
                )
                ->join('product_seller', fn ($join) =>
                    $join
                        ->on('products.id', '=', 'product_seller.product_id')
                        ->on('cart_product_seller.seller_id', '=', 'product_seller.seller_id')
                )
                ->select('products.*', 'product_seller.price', 'cart_product_seller.amount', 'product_seller.seller_id')
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
            $this->ttl(),
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
        Cache::tags([Cart::class])->flush();

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
        Cache::tags([Cart::class])->flush();

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
        Cache::tags([Cart::class])->flush();

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
        Cache::tags([Cart::class])->flush();

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
        Cache::tags([Cart::class])->flush();

        return true;
    }
}
