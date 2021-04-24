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
     * @param  string  $slug
     * @param  array  $data
     * @return bool
     */
    public function add(string $slug, array $data);

    /**
     * Удаление товара из корзины.
     *
     * @param  string  $slug
     * @return bool
     */
    public function remove(string $slug);

    /**
     * Изменяет количество товара в корзине.
     *
     * @param  string  $slug
     * @param  array  $data
     * @return bool
     */
    public function changeAmount(string $slug, array $data);

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
