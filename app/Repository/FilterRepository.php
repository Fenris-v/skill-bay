<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Pivots\ProductSeller;
use App\Models\Pivots\ProductSpecification;
use App\Models\Seller;
use App\Models\Specification;
use App\Traits\WithChildrenCategoriesFilter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class FilterRepository
{
    use WithChildrenCategoriesFilter;

    public function __construct(public ConfigRepository $configs)
    {
    }

    /**
     * Продавцы в категории
     * @param Category|null $category
     * @return Collection
     */
    public function getSellers(?Category $category = null): Collection
    {
        return Cache::tags(ConfigRepository::GLOBAL_CACHE_TAG)
            ->remember(
                $this->getCacheKey($category, 'sellers'),
                $this->configs->getCacheLifetime(),
                function () use ($category) {
                    return Seller::when(
                        isset($category->id),
                        function ($query) use ($category) {
                            return $query->whereHas(
                                'products',
                                function ($query) use ($category) {
                                    $this->withChildrenCategoriesFilter($query, $category);
                                }
                            );
                        }
                    )->get(['id', 'title', 'slug']);
                }
            );
    }

    /**
     * Возвращает характеристики в соответствии с категорией
     * @param Category|null $category
     * @return Collection
     */
    public function getSpecifications(?Category $category = null): Collection
    {
        return Cache::tags(ConfigRepository::GLOBAL_CACHE_TAG)
            ->remember(
                $this->getCacheKey($category, 'properties'),
                $this->configs->getCacheLifetime(),
                function () use ($category) {
                    return Specification::when(
                        isset($category->id),
                        function ($query) use ($category) {
                            return $query->whereHas(
                                'products',
                                function ($query) use ($category) {
                                    $this->withChildrenCategoriesFilter($query, $category);
                                }
                            );
                        }
                    )->get(['id', 'title', 'slug', 'type']);
                }
            );
    }

    /**
     * Возвращает возможные значения характеристик для категории
     * @param Category|null $category
     * @return Collection
     */
    public function getSpecificationsValues(?Category $category): Collection
    {
        return Cache::tags(ConfigRepository::GLOBAL_CACHE_TAG)
            ->remember(
                $this->getCacheKey($category, 'properties_values'),
                $this->configs->getCacheLifetime(),
                function () use ($category) {
                    return ProductSpecification::when(
                        $category,
                        function ($query) use ($category) {
                            return $query->whereHas(
                                'products',
                                function ($query) use ($category) {
                                    $this->withChildrenCategoriesFilter($query, $category);
                                }
                            );
                        }
                    )->whereHas(
                        'specification',
                        function ($query) {
                            return $query->where('type', '!=', Specification::CHECKBOX);
                        }
                    )
                        ->get(['specification_id', 'value'])
                        ->unique(
                            function ($item) {
                                return $item['specification_id'] . $item['value'];
                            }
                        );
                }
            );
    }

    /**
     * Возвращает модель, содержащую минимальную и максимальную цены
     * @param Category|null $category
     * @return array
     */
    public function getMinMaxPrice(?Category $category = null): array
    {
        return Cache::tags(ConfigRepository::GLOBAL_CACHE_TAG)
            ->remember(
                $this->getCacheKey($category, 'min_max_price'),
                $this->configs->getCacheLifetime(),
                function () use ($category) {
                    $query = ProductSeller::when(
                        $category,
                        function ($query) use ($category) {
                            return $query->whereHas(
                                'product',
                                function ($query) use ($category) {
                                    $this->withChildrenCategoriesFilter($query, $category);
                                }
                            );
                        }
                    );

                    return ['min_price' => $query->min('price'), 'max_price' => $query->max('price')];
                }
            );
    }

    /**
     * Генерирует ключ для кэша
     * @param Category|null $category
     * @param string $value
     * @return string
     */
    private function getCacheKey(?Category $category, string $value): string
    {
        $key = 'catalog_';

        $key .= $value . '_';

        if (isset($category->slug)) {
            $key .= "{$category->slug}_";
        }

        $key .= request()->query('page') ?? 1;
        return $key;
    }
}
