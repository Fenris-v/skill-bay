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

        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Product::PRODUCT_CACHE_TAGS
        ])->remember('products_limited', $ttl, function () use ($amount) {
            return Product::where('limited', 1)
                ->where('id', '!=', $this->getDailyOffer()->id)
                ->orderBy('rating_sort')
                ->take($amount)
                ->with('category')
                ->with('image')
                ->get();
        });
    }

    /**
     * Возвращает товар "Предложение дня" и записывает в кэш его id
     * @return Product
     */
    public function getDailyOffer()
    {
        $ttl = Carbon::tomorrow()->diffInSeconds();

        $dailyOfferId = Cache::remember('product_daily_offer_id', $ttl, function () {
            return Product::where('limited', 1)
                ->inRandomOrder()
                ->first()
                ->id;
        });

        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Product::PRODUCT_CACHE_TAGS,
        ])->remember('product_daily_offer', $ttl, function () use ($dailyOfferId) {
                return Product::where('id', $dailyOfferId)
                    ->with('category')
                    ->with('image')
                    ->first();
        });
    }
}
