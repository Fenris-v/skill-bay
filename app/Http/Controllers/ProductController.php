<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repository\ConfigRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

class ProductController extends Controller
{
    /**
     * Список товаров (каталог/категория)
     * @param Request $request
     * @param ConfigRepository $configs
     * @param string|null $slug
     * @return View
     */
    public function index(
        Request $request,
        ConfigRepository $configs,
        string $slug = null
    ): View {
        $page = request()->has('page') ? (int)$request->query('page') : 1;
        $perPage = $configs->getPerPage();

        $products = Cache::tags(
            [ConfigRepository::GLOBAL_CACHE_TAG, Product::PRODUCT_CACHE_TAGS]
        )->remember(
            'catalog_page_' . ($slug ? "{$slug}_" : '') . "{$perPage}_{$page}",
            $configs->getCacheLifetime(),
            function () use ($perPage) {
                return Product::with(
                    [
                        'sellers' => function ($query) {
                            $query->orderBy('pivot_price');
                        }
                    ]
                )->paginate($perPage);
            }
        );

        return view('pages.catalog.categories', compact('products'));
    }

    /**
     * Метод для отображения карточки товара
     * @return View
     */
    public function show(): View
    {
        dd('Make this anyone');
    }
}
