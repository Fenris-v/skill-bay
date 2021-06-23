<?php

namespace App\Repository;

use App\Models\Pivots\ProductSeller;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Seller;
use App\Models\Visitor;
use App\Repository\ConfigRepository;
use App\Contracts\VisitorService;
use Cache;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\TimeToLiveCacheTrait;

class CartRepository
{
    use TimeToLiveCacheTrait;

    public function __construct(
        private ConfigRepository $configRepository,
        private VisitorService $visitorService,
    ) {}

    /**
     * Возвращает корзину Визитера.
     *
     * @param Visitor $visitor
     * @return Cart
     */
    protected function getVisitorCart(Visitor $visitor): Cart
    {
        $cart = Cart::where('visitor_id', $visitor->id)
            ->with('products')
            ->doesntHave('order')
            ->firstOrNew()
        ;

        if (!$cart->visitor_id) {
            $cart->visitor()->associate($visitor);
            $cart->save();
        }

        return $cart;
    }

    /**
     * Сливает корзину неавторизованного пользователя в корзину авторизованного
     *
     * @param Visitor $guest
     * @param Visitor $user
     * @return Cart
     */
    public function mergeGuestAndUserCarts(Visitor $guest, Visitor $user): Cart
    {
        $guestCart = $this->getVisitorCart($guest);
        $userCart = $this->getVisitorCart($user);

        Cache::tags([Cart::class])->flush();
        if (!$guestCart->products->count()) {
            return $userCart;
        }

        $prepareCollection = fn($item) => [
            $item->id => [
                'seller_id' => $item->pivot->seller_id,
                'amount' => $item->amount,
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

        return $userCart;
    }

    /**
     * Возвращает корзину
     *
     * @return Cart
     */
    public function getCart(): Cart
    {
        $visitor = $this->visitorService->get();

        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Cart::class,
            Visitor::class,
        ])->remember(
            'cart|' . $visitor->id,
            $this->ttl(),
            fn() => $this->getVisitorCart($visitor)
        );

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
            fn() => $cart->products()
                ->using(ProductSeller::class)
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
        if ($seller) {
            return $this->addWithSeller($product, $amount, $seller);
        }

        $this->getCart()->products()
            ->attach(
                $product,
                [
                    'amount' => $amount,
                    'seller_id' => $product->sellers->random()->id,
                ]
            )
        ;
        Cache::tags([Cart::class])->flush();

        return true;
    }

    /**
     * Добавление товара в корзину при явном указании продавца.
     *
     * @param  Product $product
     * @param  int  $amount
     * @param Seller $seller
     * @return bool
     */
    public function addWithSeller(
        Product $product,
        int  $amount,
        Seller $seller
    ): bool {
        $this->getCart()->products()
            ->attach(
                $product,
                [
                    'amount' => $amount,
                    'seller_id' => $seller->id,
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
            ->products(false)->detach($product)
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
