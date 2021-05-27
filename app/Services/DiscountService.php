<?php

namespace App\Services;

use App\Contracts\Discountable;
use App\Contracts\DiscountCalculator;
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
                    $key => $discount->sortByDesc('discount.priority')->first()->discount
                ]
            );
        }

        return $priorityDiscounts;
    }

    /**
     * Возвращает итоговую сумму корзины
     * @param $products
     * @param $discounts
     * @return float
     */
    public function getCartTotal($products, $discounts): float
    {
        return $products->reduce(
            function ($accum, $product) use ($discounts) {
                if ($discounts->get($product->slug)) {
                    $price = $this->calculateDiscountPrice(
                        $product,
                        $discounts->get($product->slug),
                        $product->price
                    );
                } else {
                    $price = $product->price;
                }

                return $accum + $price * $product->amount;
            },
            0
        );
    }

    /**
     * Получить скидку на корзину
     * @param Collection $products
     * @return Collection
     */
    public function getCartDiscount(Collection $products): Collection
    {
        $discountUnits = $this->repository->getProductDiscounts($products);

        $groupDiscounts = $this->getGroupsDiscounts($discountUnits);

        if (!$groupDiscounts->isEmpty()) {
            return $this->getGroupDiscount($groupDiscounts, $discountUnits, $products);
        }

        return $this->getPriorityDiscount($products);
    }

    /**
     * Возвращает приоритетную скидку на группу в корзине
     * @param Collection $groupDiscounts
     * @return Discount
     */
    private function getPriorityCartDiscount(Collection $groupDiscounts): Discount
    {
        $discounts = collect();
        foreach ($groupDiscounts as $groupDiscount) {
            $discounts = $discounts->mergeRecursive([$groupDiscount->first()->discount]);
        }

        return $discounts->sortByDesc('priority')->first();
    }

    /**
     * Возвращает приоритетную скидку на группу в корзине в виде коллекции
     * "слаг" => "объект скидки"
     * @param Collection $groupDiscounts
     * @param Collection $discountUnits
     * @param Collection $products
     * @return Collection
     */
    private function getGroupDiscount(
        Collection $groupDiscounts,
        Collection $discountUnits,
        Collection $products
    ): Collection {
        $discount = $this->getPriorityCartDiscount($groupDiscounts);

        $units = $discountUnits->where('discount_id', $discount->id);

        $productsId = collect();
        $categoriesId = collect();
        foreach ($units as $unit) {
            $productsId = $productsId->mergeRecursive($unit?->products?->pluck('id'));
            $categoriesId = $categoriesId->mergeRecursive($unit?->categories?->pluck('id'));
        }

        $products = $products->filter(
            function ($product) use ($productsId, $categoriesId) {
                return in_array($product->category_id, $categoriesId->toArray()) ||
                    in_array($product->id, $productsId->toArray());
            }
        );

        $discountMap = collect();
        foreach ($products as $product) {
            $discountMap = $discountMap->mergeRecursive(
                [
                    $product->slug => $discount
                ]
            );
        }

        return $discountMap;
    }

    /**
     * Возвращает скидки на группы
     * @param $discounts
     * @return mixed
     */
    private function getGroupsDiscounts($discounts): Collection
    {
        $groupDiscounts = $discounts
            ->where('discount.type', Discount::GROUP)
            ->groupBy('discount_id');

        return $groupDiscounts->filter(
            function ($group) {
                return $group->count() > 1;
            }
        );
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
