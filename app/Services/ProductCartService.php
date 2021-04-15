<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use App\Contracts\ProductCartService as ProductCartServiceContract;

/**
 * Класс-сервис для работы с корзиной товаров.
 *
 * @author Roman Sarvarov <roman.sarvarov@gmail.com>
 */
class ProductCartService implements ProductCartServiceContract
{
    /**
     * Добавление товара в корзину.
     *
     * @param  Product  $product
     * @param  int  $amount
     * @return bool
     */
    public function add(Product $product, int $amount = 1)
    {
        // @todo Реализовать метод

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
