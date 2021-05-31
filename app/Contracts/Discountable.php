<?php

namespace App\Contracts;

use App\Models\Discount;
use App\Models\Product;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

interface Discountable
{
    /**
     * Возвращает все скидки
     * @param Product|Collection|Paginator $products
     * @return Collection
     */
    public function getAllDiscounts(Product|Collection|Paginator $products): Collection;

    /**
     * Возвращает приоритетную скидку
     * @param Product|Collection|Paginator $products
     * @return Collection
     */
    public function getPriorityDiscount(Product|Collection|Paginator $products): Collection;

    /**
     * Получить скидку на корзину
     * @param Collection $products
     * @return Collection
     */
    public function getCartDiscount(Collection $products): Collection;

    /**
     * Рассчитывает цену со скидкой
     * @param Product $product
     * @param Discount $discount
     * @param float|null $price
     * @return float
     */
    public function calculateDiscountPrice(Product $product, Discount $discount, ?float $price = null): float;
}
