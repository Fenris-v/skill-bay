<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repository\FilterRepository;
use App\Repository\CatalogRepository;
use App\Repository\ProductRepository;
use App\Repository\SellerRepository;
use Illuminate\Contracts\View\View;
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
     * @param ProductRepository $productRepository
     * @param ProductViewHistoryService $productViewHistoryService
     * @param string|null $slug
     * @return View
     */
    public function show(
        ProductRepository $productRepository,
        ProductViewHistoryService $productViewHistoryService,
        string $slug = null
    ): View {
        $product = $productRepository->getProductBySlug($slug);
        $productViewHistoryService->add($product);

        return view('pages.main.product', compact('product'));
    }

    /**
     * Метод для добавления товара в корзину
     * @param Request $request
     * @param ProductCartService $productCartService
     * @param ProductRepository $productRepository
     * @param string $slug
     * @return null
     */
    public function addToCart(
        Request $request,
        ProductCartService $productCartService,
        ProductRepository $productRepository,
        string $slug
    ) {
        $amount = (int) $request->validate([
            'amount' => 'required|integer|min:1',
        ])['amount'];

        if ($productCartService->add(
            $productRepository->getProductBySlug($slug),
            $amount
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
     * @param ProductRepository $productRepository
     * @param SellerRepository $sellerRepository
     * @param string $productSlug
     * @param string $sellerSlug
     * @return null
     */
    public function addToCartWithSeller(
        ProductCartService $productCartService,
        ProductRepository $productRepository,
        SellerRepository $sellerRepository,
        string $productSlug,
        string $sellerSlug
    ) {
        $product = $productRepository->getProductBySlug($productSlug);
        if ($productCartService->add(
            $product,
            1,
            $sellerRepository->getSellerBySlugFromProduct($product, $sellerSlug)
        )) {
            $message = __('productMessages.addToCart.success.withSeller', [
                'amount' => 1,
                'seller' => $sellerSlug,
            ]);
        } else {
            $message = __('productMessages.addToCart.error');
        }

        return back()->withInput()->with('message', $message);
    }

    /**
     * Метод для добавления товара для сравнения
     * @param CompareProductsService $compareProductsService
     * @param ProductRepository $productRepository
     * @param string $slug
     * @return null
     */
    public function addToCompare(
        CompareProductsService $compareProductsService,
        ProductRepository $productRepository,
        string $slug
    ) {
        if ($compareProductsService->add(
            $productRepository->getProductBySlug($slug)
        )) {
            $message = __('productMessages.addToCompare.success');
        } else {
            $message = __('productMessages.addToCompare.error');
        }

        return back()->withInput()->with('message', $message);
    }
}
