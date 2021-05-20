<?php

namespace App\Repository;

use App\Models\Discount;
use App\Traits\TimeToLiveCacheTrait;
use Cache;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DiscountRepository
{
    use TimeToLiveCacheTrait;

    public function __construct(private ConfigRepository $configRepository)
    {}

    /**
     * Возвращает список пагинированных скидок.
     *
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function getPaginateDiscounts(array $params = []): LengthAwarePaginator
    {
        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Discount::class,
        ])->remember(
            'discount_page',
            $this->ttl(),
            fn() => Discount::with(['image'])
                ->paginate($this->configRepository->getPerPage())
        );
    }
}
