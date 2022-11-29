<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\HistoryOrderController;

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

Route::get('/', [HomeController::class, 'welcome']);

Route::resource('product', ProductController::class);

Route::middleware(['Auth'])->group(function () {

    Route::resource('home', HomeController::class);
    Route::resource('cart', CartController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('history', HistoryOrderController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('category', CategoryController::class);

    Route::get('updateCart/{key}/{qty}', [HomeController::class, 'updateCart']);

    Route::middleware(['is_admin'])->group(function () {
        Route::prefix('admin')->group(function () {

            Route::get('dashboard', [AdminController::class, 'home'])->name('dashboard.admin');
            Route::resource('addproduct', AdminProductController::class);
            Route::get('order', [AdminController::class, 'order'])->name('order.page');
            Route::get('confirm/{id}', [AdminController::class, 'confirm'])->name('order.confirm');
            Route::get('arrived/{id}', [AdminController::class, 'arrived'])->name('order.arrived');
            Route::get('reject/{id}', [AdminController::class, 'reject'])->name('order.reject');

        });
    });
});

require __DIR__.'/auth.php';
