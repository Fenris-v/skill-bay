<?php

declare(strict_types=1);

use App\Orchid\Screens\Banner\BannerEditScreen;
use App\Orchid\Screens\Banner\BannerListScreen;
use App\Orchid\Screens\Callback\CallbackListScreen;
use App\Orchid\Screens\Callback\CallbackShowScreen;
use App\Orchid\Screens\Config\ConfigsEditScreen;
use App\Orchid\Screens\Config\InfoEditScreen;
use App\Orchid\Screens\Order\OrderEditScreen;
use App\Orchid\Screens\Order\OrderListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Product\ProductEditScreen;
use App\Orchid\Screens\Product\ProductListScreen;
use App\Orchid\Screens\ProductReview\ProductReviewEditScreen;
use App\Orchid\Screens\ProductReview\ProductReviewListScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use App\Orchid\Screens\Category\CategoryEditScreen;
use App\Orchid\Screens\Category\CategoryListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;


/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(
        function (Trail $trail) {
            return $trail
                ->parent('platform.index')
                ->push(__('Profile'), route('platform.profile'));
        }
    );

// Platform > System > Users
Route::screen('users/{users}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(
        function (Trail $trail, $user) {
            return $trail
                ->parent('platform.systems.users')
                ->push(__('Edit'), route('platform.systems.users.edit', $user));
        }
    );

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(
        function (Trail $trail) {
            return $trail
                ->parent('platform.systems.users')
                ->push(__('Create'), route('platform.systems.users.create'));
        }
    );

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(
        function (Trail $trail) {
            return $trail
                ->parent('platform.systems.index')
                ->push(__('Users'), route('platform.systems.users'));
        }
    );

// Platform > System > Roles > Role
Route::screen('roles/{roles}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(
        function (Trail $trail, $role) {
            return $trail
                ->parent('platform.systems.roles')
                ->push(__('Role'), route('platform.systems.roles.edit', $role));
        }
    );

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(
        function (Trail $trail) {
            return $trail
                ->parent('platform.systems.roles')
                ->push(__('Create'), route('platform.systems.roles.create'));
        }
    );

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(
        function (Trail $trail) {
            return $trail
                ->parent('platform.systems.index')
                ->push(__('Roles'), route('platform.systems.roles'));
        }
    );

/** Пользовательские маршруты */
Route::screen('config/edit', ConfigsEditScreen::class)
    ->name('platform.edit.config');

Route::screen('contacts/edit', InfoEditScreen::class)
    ->name('platform.edit.contacts');

// Товары.
Route::screen('products/create', ProductEditScreen::class)
    ->name('platform.product.create');

Route::screen('products/{product}', ProductEditScreen::class)
    ->name('platform.product.edit');

Route::screen('products', ProductListScreen::class)
    ->name('platform.product.list');

// Отзывы к товарам.
Route::screen('product-reviews/create', ProductReviewEditScreen::class)
    ->name('platform.product-review.create');

Route::screen('product-reviews/{productReview}', ProductReviewEditScreen::class)
    ->name('platform.product-review.edit');

Route::screen('product-reviews', ProductReviewListScreen::class)
    ->name('platform.product-review.list');

// Баннеры.
Route::screen('banners/create', BannerEditScreen::class)
    ->name('platform.banner.create');

Route::screen('banners/{banner}', BannerEditScreen::class)
    ->name('platform.banner.edit');

Route::screen('banners', BannerListScreen::class)
    ->name('platform.banner.list');

// Заказы.
Route::screen('orders/create', OrderEditScreen::class)
    ->name('platform.order.create');

Route::screen('orders/{order}', OrderEditScreen::class)
    ->name('platform.order.edit');

Route::screen('orders', OrderListScreen::class)
    ->name('platform.order.list');

// Категории товаров.
Route::screen('categories/create', CategoryEditScreen::class)
    ->name('platform.category.create');

Route::screen('categories/{category}', CategoryEditScreen::class)
    ->name('platform.category.edit');

Route::screen('categories', CategoryListScreen::class)
    ->name('platform.category.list');

// Обратная связь
Route::screen('callbacks', CallbackListScreen::class)
    ->name('platform.callback.list');

Route::screen('callback/{callback}', CallbackShowScreen::class)
    ->name('platform.callback.show');
