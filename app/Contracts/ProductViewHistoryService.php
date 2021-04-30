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
