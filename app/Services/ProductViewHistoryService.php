<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use App\Contracts\ProductViewHistoryService as ProductViewHistoryServiceContract;

/**
 * Класс-сервис, который отвечает за историю просмотров товаров.
 *
 * @author Roman Sarvarov <roman.sarvarov@gmail.com>
 */
class ProductViewHistoryService implements ProductViewHistoryServiceContract
{
    /**
     * Добавление товара в список просмотренных товаров.
     *
     * @param  Product  $product
     * @return bool
     */
    public function add(Product $product)
    {
        // @todo Реализовать метод

        return true;
    }

    /**
     * Удаление товара из списка просмотренных товаров.
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
     * Возвращает булево значение факта просмотра товара.
     *
     * @param  Product  $product
     * @return bool
     */
    public function has(Product $product)
    {
        // @todo Реализовать метод

        return true;
    }

    /**
     * Возвращает коллекцию просмотренных товаров.
     *
     * @return  Collection|Product[]
     */
    public function get()
    {
        // @todo Реализовать метод

        return Product::factory()->count(5)->make();
    }

    /**
     * Возвращает количество просмотренных товаров.
     *
     * @return  int
     */
    public function count()
    {
        // @todo Реализовать метод

        return $this->get()->count();
    }
}
