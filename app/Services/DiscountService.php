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
use App\Contracts\ProductCartService;

class DiscountService implements Discountable
{
    public function __construct(
        protected DiscountRepository $repository,
        protected ProductCartService $productCartService
    ) {}

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
                    $key => $discount->sortByDesc('discount.priority')->first()->discount ?? null
                ]
            );
        }

        return $priorityDiscounts;
    }

    /**
     * Возвращает итоговую сумму корзины
     * @return float
     */
    public function getCartTotal(): float {
        $products = $this->productCartService->get();
        $discounts = $this->getCartDiscount($products);

        if ($discounts->first()?->type === Discount::GROUP) {
            $total = $products->reduce(
                function ($accum, $product) use ($discounts) {
                    return $accum + $product->price * $product->amount;
                },
                0
            );
            return $total - $this->calculateGroupDiscount($discounts->first(), $total);
        }

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
        $discountUnits = $this->repository
            ->getProductDiscounts($products, [Discount::PRODUCT, Discount::GROUP]);

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
     * @param Collection $discounts
     * @return mixed
     */
    private function getGroupsDiscounts(Collection $discounts): Collection
    {
        $groupDiscounts = $discounts
            ->where('discount.type', Discount::GROUP)
            ->groupBy('discount_id');

        return $groupDiscounts->filter(
            function ($group) {
                return $group->count() > 1 || $group[0]->categories->count() > 1;
            }
        );
    }

    /**
     * Рассчитывает скидку на группу в корзине
     * @param Discount $discount
     * @param float $price
     * @return float
     */
    private function calculateGroupDiscount(Discount $discount, float $price): float
    {
        $calculator = $this->createCalculator($discount->unit_type);

        return $calculator->getGroupDiscount($discount, $price);
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

    public function getAppliedDiscountAndPrice()
    {
        $products = $this->productCartService->get();
        $discounts = $this->getCartDiscount($products);

        $discountFirst = $discounts->first();
        $total = $products->reduce(
            function ($accum, $product) use ($discounts) {
                return $accum + $product->price * $product->amount;
            },
            0
        );

        return match($discountFirst?->type) {
            Discount::GROUP => [
                'type' => Discount::GROUP,
                'applied' => [
                    'used_discount' => $usedDiscount = $this->calculateGroupDiscount($discounts->first(), $total),
                    'used_price' => $usedPrice = $total - $usedDiscount,
                ],
                'total' => [
                    'used_discount' => $usedDiscount,
                    'used_price' => $usedPrice,
                ],
            ],
            Discount::CART => [
                'type' => Discount::CART,
                'applied' => [
                    'used_discount' => $usedDiscount = $discountFirst->value,
                    'used_price' => $usedPrice = $total - $usedDiscount,
                ],
                'total' => [
                    'used_discount' => $usedDiscount,
                    'used_price' => $usedPrice,
                ],
            ],
            default => [
                'type' => Discount::PRODUCT,
                'applied' => $result = collect($products->mapWithKeys(
                    fn($product) => [
                        $product->id => [
                            'used_price' => $currentPrice = $discounts->get($product->slug)
                                ? $this->calculateDiscountPrice(
                                    $product,
                                    $discounts->get($product->slug),
                                    $product->price
                                )
                                : $product->price
                            ,
                            'used_discount' => $product->price - $currentPrice,
                            'amount' => $product->amount,
                            'seller_id' => $product->pivot->seller_id,
                        ]
                    ]
                )),
                'total' => [
                    'used_discount' => $usedDiscount = $result->reduce(
                        fn($accum, $item) => $accum + $item['used_discount'] * $item['amount'],
                        0
                    ),
                    'used_price' => $total - $usedDiscount,
                ],
            ],
        };
    }
}
