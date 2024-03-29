<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', fn () => redirect('login'));

// 認証内
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // 売上
    Route::resource('/orders', \App\Http\Controllers\OrderController::class)->names([
        'index'   => 'order',
        'create'  => 'order.create',
        'store'   => 'order.store',
        'show'    => 'order.show',
        'update'  => 'order.update',
        'destroy' => 'order.destroy',
    ]);
    Route::put(
        '/orders/{order}/set-orders-delivered',
        [\App\Http\Controllers\OrderController::class, 'setOrdersDelivered'],
    )->name('order.set-orders-delivered');

    // カテゴリ
    Route::resource('/categories', \App\Http\Controllers\CategoryController::class)->names([
        'index'   => 'category',
        'create'  => 'category.create',
        'store'   => 'category.store',
        'show'    => 'category.show',
        'update'  => 'category.update',
        'destroy' => 'category.destroy',
    ]);
    Route::put(
        '/categories/{category}/disabled',
        [\App\Http\Controllers\CategoryController::class, 'disabled'],
    )->name('category.disabled');

    // 商品
    Route::resource('/items', \App\Http\Controllers\ItemController::class)->names([
        'index'   => 'item',
        'create'  => 'item.create',
        'store'   => 'item.store',
        'show'    => 'item.show',
        'update'  => 'item.update',
        'destroy' => 'item.destroy',
    ]);

    // アカウント
    Route::resource('/users', \App\Http\Controllers\UserController::class)->names([
        'index'   => 'user',
        'create'  => 'user.create',
        'store'   => 'user.store',
        'show'    => 'user.show',
        'update'  => 'user.update',
        'destroy' => 'user.destroy',
    ]);

    // 各種設定
    Route::resource('/configs', \App\Http\Controllers\ConfigController::class)->names([
        'index'   => 'config',
        'create'  => 'config.create',
        'store'   => 'config.store',
        'show'    => 'config.show',
        'update'  => 'config.update',
        'destroy' => 'config.destroy',
    ]);
});
