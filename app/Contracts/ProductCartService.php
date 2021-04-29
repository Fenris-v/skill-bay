<?php


namespace App\Contracts;


use App\Models\Product;
use App\Models\Seller;
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
     * @param  Seller|null  $seller
     * @return bool
     */
    public function add(
        Product $product,
        int $amount,
        Seller $seller = null
    ): bool;

    /**
     * Удаление товара из корзины.
     *
     * @param  Product  $product
     * @return bool
     */
    public function remove(Product  $product): bool;

    /**
     * Изменяет количество товара в корзине.
     *
     * @param  Product  $product
     * @param  int  $amount
     * @return bool
     */
    public function changeAmount(
        Product  $product,
        int $amount
    ): bool;

    /**
     * Изменяет продавца у товара в корзине.
     *
     * @param  Product  $product
     * @param  Seller  $seller
     * @return bool
     */
    public function changeSeller(
        Product  $product,
        Seller  $seller
    ): bool;

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
