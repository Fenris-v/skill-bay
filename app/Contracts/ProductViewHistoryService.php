<?php


namespace App\Contracts;


use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

/**
 * Класс-сервис, который отвечает за историю просмотров товаров.
 *
 * @author Roman Sarvarov <roman.sarvarov@gmail.com>
 */
interface ProductViewHistoryService
{
    /**
     * Добавление товара в список просмотренных товаров.
     *
     * @param  Product  $product
     * @return bool
     */
    public function add(Product $product);

    /**
     * Удаление товара из списка просмотренных товаров.
     *
     * @param  Product  $product
     * @return bool
     */
    public function remove(Product $product);

    /**
     * Возвращает булево значение факта просмотра товара.
     *
     * @param  Product  $product
     * @return bool
     */
    public function has(Product $product);

    /**
     * Возвращает коллекцию просмотренных товаров.
     *
     * @return  Collection|Product[]
     */
    public function get();

    /**
     * Возвращает количество просмотренных товаров.
     *
     * @return  int
     */
    public function count();
}
