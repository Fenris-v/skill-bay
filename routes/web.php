<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;

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
)->name('index');

Route::get('/catalog/{slug?}', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/product/{slug}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/seller/{seller}', [SellerController::class, 'show'])
    ->name('seller');
