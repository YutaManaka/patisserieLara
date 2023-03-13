<?php

use Illuminate\Foundation\Application;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
});

// 認証内
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

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
