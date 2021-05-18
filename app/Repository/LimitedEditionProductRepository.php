<?php


namespace App\Repository;


use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Cache;

class LimitedEditionProductRepository
{
    private $configRepository;

    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    /**
     * Возвращает 16 случайных товаров с отметкой "Ограниченный тираж"
     *
     * @return Collection|Product[]
     */
    public function get($amount)
    {
        return $this->getAll()
            ->where('daily_offer', 0)
            ->whereNotIn('id', $this->getDailyOffer()->id)
            ->shuffle()
            ->take($amount);
    }

    /**
     * Возвращает все товары с отметкой "Ограниченный тираж"
     *
     * @return Collection|Product[]
     */
    public function getAll()
    {
        $ttl = $this->configRepository->getCacheLifetime(now()->addDay());

        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Product::PRODUCT_CACHE_TAGS
        ])->remember('products_limited', $ttl, function () {
            return Product::where('limited', 1)
                ->get();
        });
    }

    /**
     * Возвращает все товары с отметкой "Ограниченный тираж"
     *
     * @return Collection|Product[]
     */
    public function getDailyOffer()
    {
        $ttl = Carbon::tomorrow()->diffInSeconds();

        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Product::PRODUCT_CACHE_TAGS
        ])->remember('products_daily_offer', $ttl, function () {
            return $this->getAll()->random();
        });
    }
}
