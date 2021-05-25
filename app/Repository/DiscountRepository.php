<?php

namespace App\Repository;

use App\Models\Discount;
use App\Models\DiscountUnit;
use App\Traits\TimeToLiveCacheTrait;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class DiscountRepository
{
    use TimeToLiveCacheTrait;

    public function __construct(private ConfigRepository $configRepository)
    {
    }

    /**
     * Возвращает все скидки
     * @param Collection|Paginator $products
     * @return Collection $discounts
     */
    public function getProductDiscounts(Collection|Paginator $products): Collection
    {
        $productsId = $products->pluck(['id']);
        $categoriesId = $products->pluck(['category_id']);

        return DiscountUnit::with(
            [
                'products' => function ($query) use ($productsId) {
                    $query->whereIn('id', $productsId);
                },
                'categories' => function ($query) use ($categoriesId) {
                    $query->whereIn('id', $categoriesId);
                },
                'discount' => function ($query) {
                    $query->where('end_at', null)
                        ->orWhere('end_at', '>', now());
                }
            ]
        )->whereHas(
            'products',
            function ($query) use ($productsId) {
                $query->whereIn('id', $productsId);
            }
        )->orWhereHas(
            'categories',
            function ($query) use ($categoriesId) {
                $query->whereIn('id', $categoriesId);
            }
        )->get();
    }

    /**
     * Возвращает список пагинированных скидок.
     *
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function getPaginateDiscounts(int $page = 1): LengthAwarePaginator
    {
        $now = Carbon::now();
        return Cache::tags(
            [
                ConfigRepository::GLOBAL_CACHE_TAG,
                Discount::class,
            ]
        )->remember(
            'discount_page_' . $page,
            $this->ttl(),
            fn() => Discount::with(['image'])
                ->where(
                    fn($query) => $query
                        ->whereDate('begin_at', '<=', $now)
                        ->orWhereNull('begin_at')
                )
                ->where(
                    fn($query) => $query
                        ->whereDate('end_at', '>=', $now)
                        ->orWhereNull('end_at')
                )
                ->orWhere(
                    fn($query) => $query
                        ->whereNull('begin_at')
                        ->whereNull('end_at')
                )
                ->paginate($this->configRepository->getPerPage())
        );
    }
}
