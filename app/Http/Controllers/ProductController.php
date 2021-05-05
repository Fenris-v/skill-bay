<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repository\FilterRepository;
use App\Repository\CatalogRepository;
use App\Repository\ProductRepository;
use App\Repository\SellerRepository;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Seller;
use App\Models\Attachment;
use App\Models\Specification;
use App\Repository\ConfigRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Services\ProductCartService;
use App\Services\CompareProductsService;
use App\Services\ProductViewHistoryService;

class ProductController extends Controller
{
    public function __construct(
        protected ProductRepository $productRepository
    ) {
        //
    }

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
     * @param ProductViewHistoryService $productViewHistoryService
     * @param string|null $slug
     * @return View
     */
    public function show(
        ProductViewHistoryService $productViewHistoryService,
        string $slug = null
    ): View {
        $product = $this->productRepository->getProductBySlug($slug);
        $productViewHistoryService->add($product);

        return view('pages.main.product', compact('product'));
    }

    /**
     * Метод для добавления товара в корзину
     * @param Request $request
     * @param ProductCartService $productCartService
     * @param string $slug
     * @return null
     */
    public function addToCart(
        Request $request,
        ProductCartService $productCartService,
        string $slug
    ) {
        $amount = (int) current($request->validate([
            'amount' => 'required|integer|min:1',
        ]));

        if ($productCartService->add(
            $this->productRepository->getProductBySlug($slug),
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
     * @param SellerRepository $sellerRepository
     * @param string $productSlug
     * @param string $sellerSlug
     * @return null
     */
    public function addToCartWithSeller(
        ProductCartService $productCartService,
        SellerRepository $sellerRepository,
        string $productSlug,
        string $sellerSlug
    ) {
        $product = $this->productRepository->getProductBySlug($productSlug);
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
     * @param string $slug
     * @return null
     */
    public function addToCompare(
        CompareProductsService $compareProductsService,
        string $slug
    ) {
        if ($compareProductsService->add(
            $this->productRepository->getProductBySlug($slug)
        )) {
            $message = __('productMessages.addToCompare.success');
        } else {
            $message = __('productMessages.addToCompare.error');
        }

        return back()->withInput()->with('message', $message);
    }
}
