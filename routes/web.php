<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\HistoryProductController;
use App\Http\Controllers\InfoPageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrdersHistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get(
    '/',
    function () {
        return view('pages.main.index');
    }
)
    ->name('index')
    ->breadcrumbs(
        fn(Trail $trail) => $trail->push(__('navigation.main'), route('index'))
    );

Route::get('/catalog/{slug?}', [ProductController::class, 'index'])
    ->name('products.index')
    ->breadcrumbs(
        fn(Trail $trail, $slug = null) => $trail
            ->parent('index')
            ->push(__('navigation.catalog'), route('products.index', $slug))
    );

Route::get('/products/{product}/reviews', [ProductController::class, 'reviews'])
    ->name('products.reviews');
Route::post('/products/{product}', [ProductController::class, 'storeReview'])
    ->name('products.store-review');
Route::get('/products', fn() => redirect()->route('products.index'))
    ->name('products');

Route::get('/products/{slug}', [ProductController::class, 'show'])
    ->name('products.show')
    ->breadcrumbs(
        fn(Trail $trail, $product) => $trail
            ->parent('index')
            ->push(__('navigation.product'), route('products.show', $product))
    );

Route::get('/sellers/{seller}', [SellerController::class, 'show'])
    ->name('sellers')
    ->breadcrumbs(
        fn(Trail $trail, $seller) => $trail
            ->parent('index')
            ->push(__('navigation.seller'), route('sellers', $seller))
    );

Route::get('/compare', [ProductController::class, 'compare'])
    ->name('compare')
    ->breadcrumbs(
        fn(Trail $trail) => $trail
            ->parent('index')
            ->push(__('navigation.compare'), route('compare'))
    );

Route::prefix('/products')
    ->group(
        function () {
            Route::post('/{slug}/add-to-cart', [ProductController::class, 'addToCart'])
                ->name('products.addToCart');
            Route::post(
                '/{productSlug}/seller/{sellerSlug}/add-to-cart',
                [ProductController::class, 'addToCartWithSeller']
            )
                ->name('products.addToCartWithSeller');
            Route::post('/{slug}/add-to-compare', [ProductController::class, 'addToCompare'])
                ->name('products.addToCompare');
            Route::post('/{product}/remove-from-compare', [ProductController::class, 'removeFromCompare'])
                ->name('products.removeFromCompare');
        }
    );

Route::prefix('/cart')
    ->group(
        function () {
            Route::get('/', [CartController::class, 'show'])
                ->name('cart.show')
                ->breadcrumbs(
                    fn(Trail $trail) => $trail
                        ->parent('index')
                        ->push(__('navigation.cart'), route('cart.show'))
                );
            Route::patch('/{slug}/remove', [CartController::class, 'removeProduct'])
                ->name('cart.removeProduct');
            Route::patch('/{slug}/change-amount', [CartController::class, 'changeProductAmount'])
                ->name('cart.changeProductAmount');
            Route::patch('/{productSlug}/change-seller', [CartController::class, 'changeProductSeller'])
                ->name('cart.changeProductSeller');
        }
    );

Route::prefix('/account')
    ->middleware('auth')
    ->group(
        function () {
            Route::get('/', [AccountController::class, 'index'])
                ->name('account')
                ->breadcrumbs(
                    function (Trail $trail) {
                        $trail->parent('index')
                            ->push(__('navigation.account'), route('account'));
                    }
                );

            Route::get('/profile', [AccountController::class, 'show'])
                ->name('profile')
                ->breadcrumbs(
                    function (Trail $trail) {
                        $trail->parent('account')
                            ->push(__('navigation.account'), route('profile'));
                    }
                );
            Route::put('/profile', [AccountController::class, 'editProfile'])
                ->name('profile.edit')
                ->breadcrumbs(
                    function (Trail $trail) {
                        $trail->parent('account')
                            ->push(__('navigation.account'), route('profile'));
                    }
                );
            Route::delete('/profile/avatar', [AccountController::class, 'deleteAvatar'])
                ->name('profile.avatar.delete')
                ->breadcrumbs(
                    function (Trail $trail) {
                        $trail->parent('account')
                            ->push(__('navigation.account'), route('profile'));
                    }
                );

            Route::get('/views', [HistoryProductController::class, 'index'])
                ->name('viewed_history')
                ->breadcrumbs(
                    function (Trail $trail) {
                        $trail->parent('account')
                            ->push(__('navigation.history'), route('viewed_history'));
                    }
                );

            Route::get('/orders', [OrdersHistoryController::class, 'index'])
                ->name('orders.index')
                ->breadcrumbs(
                    function (Trail $trail) {
                        $trail->parent('account')
                            ->push(__('navigation.orders'), route('orders.index'));
                    }
                );

            Route::get('/orders/{order}', [OrdersHistoryController::class, 'show'])
                ->name('orders.show')
                ->breadcrumbs(
                    function (Trail $trail, $order) {
                        $trail->parent('orders.index')
                            ->push(
                                __('navigation.order', ['number' => $order]),
                                route('orders.show', $order)
                            );
                    }
                );
        }
    );

Route::middleware('cartIsNotEmpty')
    ->get('/order/personal', [OrderController::class, 'stepPersonal'])
    ->name('order.personal.get')
    ->breadcrumbs(
        fn(Trail $trail) => $trail
            ->parent('index')
            ->push(__('orderPage.title'), route('order.personal.get'))
    );
Route::post('/order/personal', [OrderController::class, 'stepPersonalStore'])
    ->name('order.personal.store');

Route::prefix('/order')
    ->middleware(['auth', 'cartIsNotEmpty'])
    ->group(
        function () {
            Route::get('/delivery', [OrderController::class, 'stepDelivery'])
                ->name('order.delivery.get')
                ->breadcrumbs(
                    fn(Trail $trail) => $trail
                        ->parent('index')
                        ->push(__('orderPage.title'), route('order.personal.get'))
                );
            Route::post('/delivery', [OrderController::class, 'stepDeliveryStore'])
                ->name('order.delivery.store');

            Route::get('/payment', [OrderController::class, 'stepPayment'])
                ->name('order.payment.get')
                ->breadcrumbs(
                    fn(Trail $trail) => $trail
                        ->parent('index')
                        ->push(__('orderPage.title'), route('order.payment.get'))
                );
            Route::post('/payment', [OrderController::class, 'stepPaymentStore'])
                ->name('order.payment.store');

            Route::get('/accept', [OrderController::class, 'stepAccept'])
                ->name('order.accept.get')
                ->breadcrumbs(
                    fn(Trail $trail) => $trail
                        ->parent('index')
                        ->push(__('orderPage.title'), route('order.personal.get'))
                );
            Route::post('/accept', [OrderController::class, 'stepAcceptStore'])
                ->name('order.accept.store');
        }
    );

Route::prefix('/order')
    ->middleware(['auth'])
    ->group(
        function () {
            Route::get('/pay/{order?}', [OrderController::class, 'stepPay'])
                ->name( 'order.pay')
                ->breadcrumbs(
                    fn(Trail $trail) => $trail
                        ->parent('index')
                        ->push(__('orderPage.title'), route('order.pay'))
                );
            Route::post('/pay/{order?}', [OrderController::class, 'stepPayStore'])
                ->name('order.pay-store');
        }
    );

Route::get('/contacts', [InfoPageController::class, 'contacts'])
    ->name('contacts')
    ->breadcrumbs(
        function (Trail $trail) {
            $trail->parent('index')
                ->push(__('navigation.contacts'), route('contacts'));
        }
    );

Route::post('contacts', [InfoPageController::class, 'store']);

Route::get('/about', [InfoPageController::class, 'about'])
    ->name('about')
    ->breadcrumbs(
        function (Trail $trail) {
            $trail->parent('index')
                ->push(__('navigation.about'), route('about'));
        }
    );

Route::get('/registration', [UserController::class, 'create'])
    ->middleware('guest')
    ->name('registration')
    ->breadcrumbs(
        function (Trail $trail) {
            $trail->parent('index')
                ->push(__('login.reg'), route('registration'));
        }
    );

Route::post('/registration', [UserController::class, 'store'])
    ->name('user.store');

Route::get('/login', [UserController::class, 'login'])
    ->middleware('guest')
    ->name('login')
    ->breadcrumbs(
        function (Trail $trail) {
            $trail->parent('index')
                ->push(__('login.auth'), route('login'));
        }
    );

Route::post('/auth', [UserController::class, 'auth'])
    ->name('auth');

Route::get('/logout', [UserController::class, 'logout'])
    ->name('logout');

Route::get('/forgot-password', [UserController::class, 'forgotPassword'])
    ->middleware('guest')
    ->name('forgot-password')
    ->breadcrumbs(
        function (Trail $trail) {
            $trail->parent('index')
                ->push(__('login.forgot'), route('forgot-password'));
        }
    );

Route::post('/forgot-password', [UserController::class, 'forgotPasswordSend'])
    ->middleware('guest')
    ->name('forgot-password-send');

Route::get('/reset-password/{token}/', [UserController::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.reset')
    ->breadcrumbs(
        function (Trail $trail) {
            $trail->parent('index')
                ->push(__('login.forgot'), route('password.reset'));
        }
    );

Route::post('/reset-password', [UserController::class, 'resetPasswordSend'])
    ->middleware('guest')
    ->name('reset-password-send');

Route::get('/login-for-order', [UserController::class, 'loginForOrder'])
    ->middleware('guest')
    ->name('loginForOrder');

Route::post('/auth-and-return-to-order', [UserController::class, 'authAndBackToOrder'])
    ->middleware('guest')
    ->name('authAndBackToOrder');


Route::get('/discounts', [DiscountController::class, 'index'])
    ->name('discounts')
    ->breadcrumbs(
        function (Trail $trail) {
            $trail->parent('index')
                ->push(__('navigation.discounts'), route('discounts'));
        }
    );
