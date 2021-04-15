<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Seller;
use App\Repository\ConfigRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Services\ProductCartService;
use App\Services\CompareProductsService;
use App\Services\ProductViewHistoryService;

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
     * @param ConfigRepository $configs
     * @param string $slug
     * @return View
     */
    public function show(
        ConfigRepository $configs,
        ProductViewHistoryService $productViewHistoryService,
        string $slug = null
    ): View {
        $product = Cache::tags(
            [ConfigRepository::GLOBAL_CACHE_TAG, Product::class, Seller::class]
        )->remember(
            'product_page|' . $slug,
            $configs->getCacheLifetime(),
            fn() => Product::where('slug', $slug)->with('sellers')->firstOrFail(),
        );

        $productViewHistoryService->add($product);

        // Нужен сервис хлебных крошек
        $breadcrumbs = [
            ['title' => 'Главная', 'url' => '/'],
            ['title' => 'Каталог', 'url' => '/catalog'],
            ['title' => 'Ноутбуки', 'url' => '/catalog/notebooks'],
            ['title' => 'Товар'],
        ];
        return view('pages.main.product', compact('product', 'breadcrumbs'));
    }

    /**
     * Метод для добавления товара в корзину
     * @param Request $request
     * @param ConfigRepository $configs
     * @param Product $product
     * @return null
     */
    public function addToCart(
        Request $request,
        ProductCartService $productCartService,
        Product $product
    ) {
        $amount = current($request->validate([
            'amount' => 'required|integer|min:1',
        ]));

        if ($productCartService->add(
            $product,
            (int) $amount,
        )) {
            session()->flash('message', "Товар в количестве {$amount} шт. успешно добавлен в корзину");
        } else {
            session()->flash('message', 'Ошибка добавления товара в корзину');
        }

        return back()->withInput();
    }
    /**
     * Метод для добавления товара в корзину с указанием продавца
     * @param ConfigRepository $configs
     * @param Product $product
     * @param Seller $seller
     * @return null
     */
    public function addToCartWithSeller(
        ProductCartService $productCartService,
        Product $product,
        Seller $seller
    ) {
        if ($productCartService->add(
            $product,
            1,
            $seller
        )) {
            session()->flash('message', "Товар у продавца {$seller->slug} успешно добавлен в корзину");
        } else {
            session()->flash('message', 'Ошибка добавления товара в корзину');
        }

        return back()->withInput();
    }

    /**
     * Метод для добавления товара для сравнения
     * @param Request $request
     * @param ConfigRepository $configs
     * @param Product $product
     * @return null
     */
    public function addToCompare(
        CompareProductsService $compareProductsService,
        Product $product
    ) {
        if ($compareProductsService->addProduct($product)) {
            session()->flash('message', 'Товар успешно добавлен для сравнения');
        } else {
            session()->flash('message', 'Возникла непредвиденная ошибка');
        }

        return back()->withInput();
    }
}
