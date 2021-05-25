<?php

namespace App\Services;

use App\Contracts\Discountable;
use App\Contracts\DiscountCalculator;
use App\Models\Cart;
use App\Models\Discount;
use App\Models\Product;
use App\Repository\DiscountRepository;
use App\Services\Calculator\CurencyDiscount;
use App\Services\Calculator\PercentDiscount;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

class DiscountService implements Discountable
{
    public function __construct(public DiscountRepository $repository)
    {
    }

    /**
     * Возвращает все скидки
     * @param Product|Collection|Paginator $products
     * @return Collection
     */
    public function getAllDiscounts(Product|Collection|Paginator $products): Collection
    {
        if ($products instanceof Product) {
            $products = collect([$products]);
        }

        $discounts = $this->repository->getProductDiscounts($products);

        $discountMap = collect();
        foreach ($products as $product) {
            $discountMap = $discountMap->mergeRecursive(
                [
                    $product->slug => $this->getUniqueDiscounts($discounts, $product)
                ]
            );
        }

        return $discountMap;
    }

    /**
     * Возвращает приоритетную скидку
     * @param Product|Collection|Paginator $products
     * @return Collection
     */
    public function getPriorityDiscount(Product|Collection|Paginator $products): Collection
    {
        if ($products instanceof Product) {
            $products = collect([$products]);
        }

        $priorityDiscounts = collect();
        foreach ($this->getAllDiscounts($products) as $key => $discount) {
            $priorityDiscounts = $priorityDiscounts->mergeRecursive(
                [
                    $key => $discount->sortByDesc('discount.priority')->first()
                ]
            );
        }

        return $priorityDiscounts;
    }

    /**
     * Получить скидку на корзину
     * @param Cart $cart
     * @return Discount
     */
    public function getCartDiscount(Cart $cart): Discount
    {
        return Discount::first();
    }

    /**
     * Рассчитывает цену со скидкой
     * @param Product $product
     * @param Discount $discount
     * @param float|null $price
     * @return float
     */
    public function calculateDiscountPrice(Product $product, Discount $discount, ?float $price = null): float
    {
        if (!$price) {
            $price = $product->sellers->sortByDesc('pivot.price')->first()->pivot->price ?? 0;
        }

        $calculator = $this->createCalculator($discount->unit_type);

        return $calculator->getPrice($discount, $price);
    }

    /**
     * Возвращает уникальные скидки для продукта
     * @param Collection|null $discounts
     * @param Product $product
     * @return Collection|null
     */
    private function getUniqueDiscounts(?Collection $discounts, Product $product): ?Collection
    {
        return $discounts->filter(
            function ($value) use ($product) {
                return $value->products->where('id', $product->id)->first()?->exists() ||
                    $value->categories->where('id', $product->category_id)->first()?->exists();
            }
        )->unique(['discount_id']);
    }

    /**
     * Возвращает нужный объект
     * @param $discountType
     * @return DiscountCalculator
     */
    private function createCalculator($discountType): DiscountCalculator
    {
        return $discountType === Discount::UNIT_CURRENCY
            ? new CurencyDiscount
            : new PercentDiscount;
    }
}
