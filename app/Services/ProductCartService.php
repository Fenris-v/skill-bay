<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Seller;
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
     * @param  int  $amount
     * @param  Seller|null  $seller
     * @return bool
     */
    public function add(
        Product $product,
        int $amount = 1,
        Seller $seller = null
    ): bool {
        if ($amount > 0) {
            $productInCart = $this->cartRepository->getCart()->products->firstWhere('slug', $product->slug);
            if ($productInCart) {
                $amount += $productInCart->amount;
                if ($seller && $productInCart->amount !== $amount) {
                    return $this->changeSellerAndAmount($product, $seller, $amount);
                } elseif ($seller) {
                    return $this->changeSeller($product, $seller);
                }
                return $this->changeAmount($product, $amount);
            }

            return $this->cartRepository->add($product, $amount, $seller);
        }

        return false;
    }

    /**
     * Удаление товара из корзины.
     *
     * @param  Product  $product
     * @return bool
     */
    public function remove(Product  $product): bool
    {
        return $this->cartRepository->remove($product);
    }

    /**
     * Изменяет количество товара в корзине.
     *
     * @param  Product $product
     * @param  int $amount
     * @return bool
     */
    public function changeAmount(
        Product $product,
        int $amount
    ): bool {
        if ($amount === 0) return $this->remove($product);

        return $this->cartRepository->changeAmount(
            $product,
            $amount
        );
    }

    /**
     * Изменяет продавца у товара в корзине.
     *
     * @param  Product $product
     * @param  Seller $seller
     * @return bool
     */
    public function changeSeller(
        Product $product,
        Seller $seller
    ): bool {
        return $this->cartRepository->changeSeller(
            $product,
            $seller
        );
    }
    /**
     * Изменяет продавца и количество у товара в корзине.
     *
     * @param  Product $product
     * @param  Seller $seller
     * @param int $amount
     * @return bool
     */
    public function changeSellerAndAmount(
        Product $product,
        Seller $seller,
        int $amount
    ): bool {
        return $this->cartRepository->changeSellerAndAmount(
            $product,
            $seller,
            $amount
        );
    }

    /**
     * Возвращает коллекцию товаров в корзине.
     *
     * @return Collection|Product[]
     */
    public function get()
    {
        return $this->cartRepository->getCartProducts();
    }

    /**
     * Возвращает количество товаров в корзине.
     *
     * @return int
     */
    public function count()
    {
        return $this->cartRepository->getCartProductsCount();
    }

    /**
     * Возвращает стоимость товаров в корзине.
     *
     * @return array
     */
    public function total()
    {
        return [
            'current' => $this->cartRepository->getCart()->currentPrice,
            'old' => $this->cartRepository->getCart()->oldPrice,
        ];
    }
}
