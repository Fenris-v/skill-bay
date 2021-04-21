<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Seller;
use App\Models\Image;
use App\Models\Specification;
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
            [
                ConfigRepository::GLOBAL_CACHE_TAG,
                Product::class,
                Seller::class,
                Image::class,
                Specification::class,
            ]
        )->remember(
            'product_page|' . $slug,
            $configs->getCacheLifetime(),
            fn() => Product::where('slug', $slug)
                ->with('sellers', 'images', 'specifications')
                ->firstOrFail()
        );

        $productViewHistoryService->add($product);

        return view('pages.main.product', compact('product'));
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
            'amount' => 'required|integer',
        ]));

        if ($productCartService->add(
            $product,
            $amount,
        )) {
            $message = __('productMessages.addToCart.success.withoutSeller', [
                'amount' => $amount,
            ]);
        } else {
            $message = __('productMessages.addToCart.error');
        }

        return back()->withInput()->with('message', $message);
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
            $message = __('productMessages.addToCart.success.withSeller', [
                'amount' => 1,
                'seller' => $seller->slug,
            ]);
        } else {
            $message = __('productMessages.addToCart.error');
        }

        return back()->withInput()->with('message', $message);
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
        if ($compareProductsService->add($product)) {
            $message = __('productMessages.addToCompare.success');
        } else {
            $message = __('productMessages.addToCompare.error');
        }

        return back()->withInput()->with('message', $message);
    }
}
