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

    /**
     * Добавление товара в корзину.
     *
     * @param  Product  $product
     * @param  int  $amount
     * @return bool
     */
    public function add(
        string $slug,
        array $data
    ) {
        $validator = Validator::make($data, [
            'amount' => 'required|integer|min:1',
        ])->validate();

        $product = $this->productRepository->getProductBySlug($slug);
        $this
            ->cartRepository
            ->getUserCart(User::where('id', 36)->first())
            ->products()
            ->attach(
                $product,
                [
                    'amount' => $data['amount'],
                    'seller_id' => $product->sellers->random()->id,
                ]
            )
        ;

        return true;
    }

    /**
     * Удаление товара из корзины.
     *
     * @param  Product  $product
     * @return bool
     */
    public function remove(Product $product)
    {
        // @todo Реализовать метод

        return true;
    }

    /**
     * Изменяет количество товара в корзине.
     *
     * @param  Product  $product
     * @param  int  $amount
     * @return bool
     */
    public function changeAmount(Product $product, int $amount)
    {
        // @todo Реализовать метод

        return true;
    }

    /**
     * Возвращает коллекцию товаров в корзине.
     *
     * @return Collection|Product[]
     */
    public function get()
    {
        // @todo Реализовать метод

        return Product::factory()->count(5)->make();
    }

    /**
     * Возвращает количество товаров в корзине.
     *
     * @return int
     */
    public function count()
    {
        // @todo Реализовать метод

        return $this->get()->count();
    }
}
