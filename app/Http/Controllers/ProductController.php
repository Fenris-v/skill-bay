<?php

namespace App\Http\Controllers;

use App\Contracts\ProductReviewService;
use App\Http\Requests\ProductReviewStoreRequest;
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
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
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
     * Сохранение отзыва.
     *
     * @param  ProductReviewStoreRequest  $request
     * @param  Product  $product
     * @param  ProductReviewService  $productReviewService
     * @return RedirectResponse
     */
    public function storeReview(
        ProductReviewStoreRequest $request,
        Product $product,
        ProductReviewService $productReviewService
    ) {
        $name = $request->get('name');
        $email = $request->get('email');
        $comment = $request->get('comment');

        $productReviewService->addReview(
            $product, $name, $email, $comment
        );

        return back()->withInput(['review' => 1])->with('success', __('productPage.review_form.success'));
    }

    /**
     * Возвращает HTML отзывов по товару.
     *
     * @param  Product  $product
     * @param  ProductReviewService  $productReviewService
     * @return Application|Factory|View
     */
    public function reviews(
        Product $product,
        ProductReviewService $productReviewService
    ) {
        $reviews = $productReviewService->getReviewListPaginator($product);

        return view(
            'components.product.product-review-list',
            compact('reviews')
        );
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
     * Метод для отображения страницы со списком товаров
     * @param CompareProductsService $compareProductsService
     * @return null
     */
    public function compare(
        CompareProductsService $compareProductsService,
    ) {
        $products = $compareProductsService->getProducts();

        //Выбор типов спецификаций
        $commonSpecTitles = $products
            ->map(function($product) {
                return $product->specifications;
            })
            ->collapse()
            ->pluck('title')
            ->duplicates()
            ->unique();

        //Выбор спецификаций сгруппированных по типу
        $allCommonSpecifications = $products
            ->map(function ($product) use ($commonSpecTitles) {
                return $product->specifications->whereIn('title', $commonSpecTitles);
            })
            ->collapse()
            ->groupBy('title');

        return view('pages.catalog.compare', compact(['products', 'allCommonSpecifications']));
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

    /**
     * Метод для удаление товара из списка сравнения
     * @param CompareProductsService $compareProductsService
     * @param Product $product
     * @return null
     */
    public function removeFromCompare(
        CompareProductsService $compareProductsService,
        Product $product
    ) {
        if ($compareProductsService->remove($product)) {
            $message = __('productMessages.removeFromCompare.success');
        } else {
            $message = __('productMessages.removeFromCompare.error');
        }

        return back()->withInput()->with('message', $message);
    }
}
