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
     * @param  string  $slug
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

        return $this->cartRepository->add($this->productRepository->getProductBySlug($slug), $data);
    }

    /**
     * Удаление товара из корзины.
     *
     * @param  string  $slug
     * @return bool
     */
    public function remove(string $slug): bool
    {
        return $this->cartRepository->remove($this->productRepository->getProductBySlug($slug));
    }

    /**
     * Изменяет количество товара в корзине.
     *
     * @param  string  $slug
     * @param  array  $data
     * @return bool
     */
    public function changeAmount(string $slug, array $data): bool
    {
        $this->validate($data, [
            'amount' => 'required|integer|min:0',
        ]);
        if ($data['amount'] == 0) return $this->remove($slug);

        return $this->cartRepository->changeAmount(
            $this->productRepository->getProductBySlug($slug),
            $data
        );
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

        return $this->cartRepository->changeSeller(
            $seller->products->first(),
            $seller
        );
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
