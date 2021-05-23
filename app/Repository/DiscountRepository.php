<?php

namespace App\Repository;

use App\Models\Discount;
use App\Traits\TimeToLiveCacheTrait;
use Cache;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class DiscountRepository
{
    use TimeToLiveCacheTrait;

    public function __construct(private ConfigRepository $configRepository)
    {}

    /**
     * Возвращает список пагинированных скидок.
     *
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function getPaginateDiscounts(int $page = 1): LengthAwarePaginator
    {
        $now = Carbon::now();
        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Discount::class,
        ])->remember(
            'discount_page_' . $page,
            $this->ttl(),
            fn() => Discount::with(['image'])
                ->where(fn($query) => $query
                    ->whereDate('begin_at', '<=', $now)
                    ->orWhereNull('begin_at')
                )
                ->where(fn($query) => $query
                    ->whereDate('end_at', '>=', $now)
                    ->orWhereNull('end_at')
                )
                ->orWhere(fn($query) => $query
                    ->whereNull('begin_at')
                    ->whereNull('end_at')
                )
                ->paginate($this->configRepository->getPerPage())
        );
    }
}
