<?php

namespace App\Repository;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Cache;

class CategoryRepository
{
    /**
     * @var ConfigRepository
     */
    public $configRepository;

    /**
     * CategoryRepository constructor.
     * @param ConfigRepository $configRepository
     */
    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    /**
     * Возвращает дерево категорий
     * @return Collection|Products[]
     */
    public function getTree()
    {
        $ttl = $this->configRepository->getCacheLifetime(now()->addDay());

        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Category::CATEGORY_CACHE_TAGS,
        ])
            ->remember('categories', $ttl, function() {
                return Category::get()->toTree();
            });
    }

    /**
     * Возвращает горячие категории.
     *
     * @param  int  $n
     * @return Collection
     */
    public function getHotCategories($n = 3)
    {
        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Category::CATEGORY_CACHE_TAGS,
        ])
            ->remember(
                'hot_categories',
                now()->addDay(),
                function () use ($n) {
                    /** @var Collection $categories */
                    $categories = Category::query()
                        ->hot()
                        ->withMin('productSellers', 'price')
                        ->take($n)
                        ->with('image')
                        ->orderBy('hot_order')
                        ->get();

                    return $categories;
                }
            );
    }
}
