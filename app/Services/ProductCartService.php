<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use App\Contracts\ProductCartService as ProductCartServiceContract;
use App\Repository\ProductRepository;
use App\Repository\CartRepository;
use Illuminate\Support\Facades\Validator;

/**
 * Класс-сервис для работы с корзиной товаров.
 *
 * @author Roman Sarvarov <roman.sarvarov@gmail.com>
 */
class ProductCartService implements ProductCartServiceContract
{
    private ProductRepository $productRepository;
    private CartRepository $cartRepository;

    public function __construct(
        ProductRepository $productRepository,
        CartRepository $cartRepository
    ) {
        $this->productRepository = $productRepository;
        $this->cartRepository = $cartRepository;
    }

    protected function validate(array $data, array $rules)
    {
        return Validator::make($data, $rules)->validate();
    }

    /**
     * Добавление товара в корзину.
     *
     * @param  Product  $product
     * @param  array  $data
     * @return bool
     */
    public function add(
        string $slug,
        array $data
    ) {
        $this->validate($data, [
            'amount' => 'required|integer|min:1',
        ]);

        $product = $this->productRepository->getProductBySlug($slug);
        $cart = $this->cartRepository->getCart();

        if ($cart->products->contains(fn($product) => $product->slug === $slug)) {
            return $this->changeAmount($slug, $data);
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
     * @param  string  $slug
     * @return bool
     */
    public function remove(string $slug)
    {
        $this->cartRepository->getCart()
            ->products()->detach($this->productRepository->getProductBySlug($slug))
        ;

        return true;
    }

    /**
     * Изменяет количество товара в корзине.
     *
     * @param  string  $slug
     * @param  array  $data
     * @return bool
     */
    public function changeAmount(string $slug, array $data)
    {
        $this->validate($data, [
            'amount' => 'required|integer|min:0',
        ]);
        if ($data['amount'] == 0) return $this->remove($slug);

        $product = $this->productRepository->getProductBySlug($slug);
        $this->cartRepository->getCart()
            ->products()->updateExistingPivot($product->id, [
                'amount' => $data['amount'],
            ]);

        return true;
    }

    /**
     * Изменяет количество товара в корзине.
     *
     * @param  string  $productSlug
     * @param  array  $data
     * @return bool
     */
    public function changeSeller(
        string $productSlug,
        array $data
    ): bool {
        $this->validate($data, ['seller' => 'string|required']);
        $seller = $this->productRepository->getSellerOfProductBySlug($productSlug, $data['seller']);
        $this->cartRepository->getCart()
            ->products()->updateExistingPivot($seller->products->first()->id, [
                'seller_id' => $seller->id,
            ]);

        return true;
    }

    /**
     * Возвращает коллекцию товаров в корзине.
     *
     * @return Collection|Product[]
     */
    public function get()
    {
        return $this->cartRepository->getCartProducts($this->cartRepository->getCart());
    }

    /**
     * Возвращает количество товаров в корзине.
     *
     * @return int
     */
    public function count()
    {
        return $this->cartRepository->getCartProductsCount($this->cartRepository->getCart());
    }

    /**
     * Возвращает стоимость товаров в корзине.
     *
     * @return array
     */
    public function total()
    {
        return $this->cartRepository->getCartTotalPrice($this->cartRepository->getCart());
    }
}
