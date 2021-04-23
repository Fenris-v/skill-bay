<?php


namespace App\Contracts;


use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

/**
 * Класс-сервис, который отвечает за
 * взаимоотношение товара и корзины товаров.
 *
 * @author Roman Sarvarov <roman.sarvarov@gmail.com>
 */
interface ProductCartService
{
    /**
     * Добавление товара в корзину.
     *
     * @param  Product  $product
     * @param  int  $amount
     * @return bool
     */
    public function add(Product $product, int $amount = 1);

    /**
     * Удаление товара из корзины.
     *
     * @param  Product  $product
     * @return bool
     */
    public function remove(Product $product);

    /**
     * Изменяет количество товара в корзине.
     *
     * @param  Product  $product
     * @param  int  $amount
     * @return bool
     */
    public function changeAmount(Product $product, int $amount);

    /**
     * Возвращает коллекцию товаров в корзине.
     *
     * @return Collection|Product[]
     */
    public function get();

    /**
     * Возвращает количество товаров в корзине.
     *
     * @return int
     */
    public function count();
}
