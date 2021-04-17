<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('pages.main.index');
})->name('index');

Route::get('/registration', [UserController::class, 'create'])->name('registration');
Route::post('/registration', [UserController::class, 'store'])->name('user.store');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/auth', [UserController::class, 'auth'])->name('auth');
Route::get('/forgot-password', [UserController::class, 'forgotPassword'])->middleware('guest')->name('forgot-password');
Route::post('/forgot-password', [UserController::class, 'forgotPasswordSend'])->middleware('guest')->name('forgot-password-send');
Route::get('/reset-password/{token}', [UserController::class, 'resetPassword'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [UserController::class, 'resetPasswordSend'])->middleware('guest')->name('reset-password-send');
