<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Product;
use App\Traits\WithChildrenCategoriesFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class CatalogRepository
{
    use WithChildrenCategoriesFilter;

    public ?string $sortBy;
    public ?string $sortType;

    public function __construct(public ConfigRepository $configs)
    {
    }

    /**
     * Возвращает товары в соответствии со всеми фильтрами, сортировками и т.д. из кэша
     * @param array $params
     * @param Category|null $category
     * @return Paginator
     */
    public function getPaginateProducts(array $params, ?Category $category): Paginator
    {
        return Cache::tags(
            [ConfigRepository::GLOBAL_CACHE_TAG, Product::PRODUCT_CACHE_TAGS]
        )->remember(
            $this->getCacheKey($params, $category->slug ?? ''),
            $this->configs->getCacheLifetime(),
            function () use ($params, $category) {
                return $this->getProducts($params, $category ?? null);
            }
        );
    }

    /**
     * Делает запрос к БД и возвращает данные
     * @param array $params
     * @param Category|null $category
     * @return LengthAwarePaginator
     */
    private function getProducts(array $params, ?Category $category): LengthAwarePaginator
    {
        $query = Product::with('image')
            ->with('category')
            ->when(
                $category,
                function ($query) use ($category) {
                    $this->withChildrenCategoriesFilter($query, $category);
                }
            )->selectRaw('*, (SELECT AVG(price) FROM product_seller WHERE products.id = product_id) as avg_price');

        $this->filterSearch($query, $params);
        $this->priceRange($query, $params);
        $this->filterSeller($query, $params);
        $this->specificationsFilter($query, $params);

        $sortBy = $params['sort']['by'] ?? 'rating_sort';
        $sortType = $params['sort']['type'] ?? 'asc';

        $this->sort($query, $sortBy, $sortType);

        return $query->paginate($this->configs->getPerPage());
    }

    /**
     * Выборка по диапазону цен. Фильтрация происходит по средней цене
     * @param Builder $query
     * @param array|null $params
     * @return void
     */
    public function priceRange(Builder $query, ?array $params): void
    {
        $query->when(
            isset($params['filter']['price']),
            function ($query) use ($params) {
                $priceRange = explode(';', $params['filter']['price']);
                return $query->whereHas(
                    'sellers',
                    function ($query) use ($priceRange) {
                        return $query->whereRaw(
                            '(SELECT AVG(price) FROM product_seller WHERE products.id = product_id) >= ?',
                            $priceRange[0]
                        )->whereRaw(
                            '(SELECT AVG(price) FROM product_seller WHERE products.id = product_id) <= ?',
                            $priceRange[1]
                        );
                    }
                );
            }
        );
    }

    /**
     * Выборка по свойству со значение true
     * @param Builder $query
     * @param string $filter
     * @return void
     */
    public function specificationCheckbox(Builder $query, string $filter): void
    {
        $query->whereHas(
            'specifications',
            function ($query) use ($filter) {
                return $query->where('slug', $filter)
                    ->where('value', true);
            }
        );
    }

    /**
     * Выборка по множеству свойств
     * @param Builder $query
     * @param string $filter
     * @param array $props
     * @return void
     */
    public function specificationMultiply(Builder $query, string $filter, array $props): void
    {
        $props = array_filter($props, 'strlen');

        if (empty($props)) {
            return;
        }

        $query->whereHas(
            'specifications',
            function ($query) use ($filter, $props) {
                return $query->where('slug', $filter)
                    ->whereIn('value', $props);
            }
        );
    }

    /**
     * Выборка по свойству
     * @param Builder $query
     * @param string $filter
     * @param string $props
     * @return void
     */
    public function specification(Builder $query, string $filter, string $props): void
    {
        $query->whereHas(
            'specifications',
            function ($query) use ($filter, $props) {
                return $query->where('slug', $filter)
                    ->where('value', $props);
            }
        );
    }

    /**
     * Фильтр по вхождению (поиск)
     * @param Builder $query
     * @param array|null $params
     * @return void
     */
    public function filterSearch(Builder $query, ?array $params): void
    {
        $query->when(
            isset($params['filter']['title']) &&
            $params['filter']['title'],
            function ($query) use ($params) {
                $query->where('title', 'like', "%{$params['filter']['title']}%");
            }
        );
    }

    /**
     * Фильтр по продавцу
     * @param Builder $query
     * @param array|null $params
     * @return void
     */
    public function filterSeller(Builder $query, ?array $params): void
    {
        $query->when(
            isset($params['filter']['seller']),
            function ($query) use ($params) {
                $query->seller($params['filter']['seller']);
            }
        );
    }

    /**
     * Фильтр по характеристикам
     * @param Builder $query
     * @param array|null $params
     * @return void
     */
    public function specificationsFilter(Builder $query, ?array $params): void
    {
        $query->when(
            isset($params['filter']['props']),
            function ($query) use ($params) {
                foreach ($params['filter']['props'] as $filter => $prop) {
                    if (!$prop) {
                        continue;
                    }

                    if ($prop === 'on') {
                        $this->specificationCheckbox($query, $filter);
                        continue;
                    }

                    if (is_array($prop)) {
                        $this->specificationMultiply($query, $filter, $prop);
                        continue;
                    }

                    $this->specification($query, $filter, $prop);
                }
            }
        );
    }

    /**
     * Метод сортировки
     * @param Builder $query
     * @param string $sortBy
     * @param string $sortType
     * @return void
     */
    private function sort(Builder $query, string $sortBy, string $sortType): void
    {
        match ($sortBy) {
            'popularity' => $query, // TODO: сделать, когда появятся популярные товары
            'price' => $query->orderBy('avg_price', $sortType),
            'reviews' => $query->withCount('reviews')->orderBy('reviews_count', $sortType),
            'newer' => $query->orderBy('created_at', $sortType),
            default => $query->orderBy('rating_sort', $sortType),
        };
    }

    /**
     * Создает ключ для кэша
     * @param array|null $params
     * @param string $slug
     * @return string
     */
    private function getCacheKey(?array $params, string $slug): string
    {
        $cacheKey = 'catalog_page_';

        if ($slug) {
            $cacheKey .= $slug . '_';
        }

        $cacheKey .= serialize($params);

        $cacheKey .= '_' . $this->configs->getPerPage();

        return $cacheKey;
    }
}
