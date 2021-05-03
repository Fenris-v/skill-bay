<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repository\FilterRepository;
use App\Repository\CatalogRepository;
use App\Models\Product;
use App\Models\ProductReview;
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
     * @param CatalogRepository $catalog
     * @param FilterRepository $filters
     * @param Request $request
     * @param string|null $slug
     * @return View
     */
    public function index(
        CatalogRepository $catalog,
        FilterRepository $filters,
        Request $request,
        ?string $slug = null
    ): View {
        $category = Category::where('slug', $slug)->first(['id', 'slug']);

        $params = $request->only(['filter', 'sort', 'page']);
        $products = $catalog->getPaginateProducts($params, $category ?? null);

        $sellers = $filters->getSellers($category);
        $specifications = $filters->getSpecifications($category);
        $specificationsValues = $filters->getSpecificationsValues($category);

        $minMaxPrice = $filters->getMinMaxPrice($category);

        $products->withQueryString()->onEachSide(1);

        return view(
            'pages.catalog.categories',
            compact(
                'products',
                'sellers',
                'specifications',
                'minMaxPrice',
                'specificationsValues'
            )
        );
    }

    /**
     * Метод для отображения карточки товара
     * @param ConfigRepository $configs
     * @param ProductViewHistoryService $productViewHistoryService
     * @param string|null $slug
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
                ProductReview::class,
            ]
        )->remember(
            'product_page|' . $slug,
            $configs->getCacheLifetime(),
            fn() => Product::where('slug', $slug)
                ->with('sellers', 'images', 'specifications', 'reviews')
                ->firstOrFail()
        );

        $productViewHistoryService->add($product);

        return view('pages.main.product', compact('product'));
    }

    /**
     * Метод для добавления товара в корзину
     * @param Request $request
     * @param ProductCartService $productCartService
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
     * @param ProductCartService $productCartService
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
     * @param CompareProductsService $compareProductsService
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
