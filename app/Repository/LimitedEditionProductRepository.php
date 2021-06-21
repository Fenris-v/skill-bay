<?php


namespace App\Repository;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Cache;

class LimitedEditionProductRepository
{
    /**
     * @var ConfigRepository
     */
    private $configRepository;

    /**
     * LimitedEditionProductRepository constructor.
     * @param ConfigRepository $configRepository
     */
    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    /**
     * Возвращает товары с отметкой "Ограниченный тираж"
     * @return Collection|Product[]
     */
    public function get($amount)
    {
        $ttl = $this->configRepository->getCacheLifetime(now()->addDay());

        $dailyOfferId = $this->getDailyOfferId();

        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Product::PRODUCT_CACHE_TAGS
        ])->remember(
            'products_limited_without_' . $dailyOfferId . '_amount_' . $amount, $ttl,
            function () use ($amount, $dailyOfferId) {
                return Product::where('limited', 1)
                    ->where('id', '!=', $dailyOfferId)
                    ->orderBy('rating_sort')
                    ->take($amount)
                    ->with([
                        'category',
                        'image',
                        'sellers',
                    ])
                    ->selectRaw('*, (SELECT AVG(price) FROM product_seller WHERE products.id = product_id) as avg_price')
                    ->get();
            });
    }

    /**
     * Возвращает товар "Предложение дня"
     * @return Product
     */
    public function getDailyOffer()
    {
        $ttl = $this->configRepository->getCacheLifetime(now()->addDay());

        $dailyOfferId = $this->getDailyOfferId();

        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Product::PRODUCT_CACHE_TAGS,
        ])->remember('product_daily_offer_' . $dailyOfferId, $ttl, function () use ($dailyOfferId) {
            return Product::where('id', $dailyOfferId)
                ->with([
                    'category',
                    'image',
                    'sellers',
                ])
                ->first();
        });
    }

    /**
     * Возвращает id товара "Предложение дня"
     */
    public function getDailyOfferId()
    {
        $ttl = $this->configRepository->getCacheLifetime(now()->addDay());

        $day = Carbon::now()->day;

        return Cache::remember('product_daily_offer_id_day_' . $day, $ttl, function () {
            return Product::where('limited', 1)
                ->inRandomOrder()
                ->first()
                ->id ?? null;
        });
    }
}
