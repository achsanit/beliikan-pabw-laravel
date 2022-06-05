<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\Seller\CategoryController;
use App\Http\Controllers\Api\Seller\ProductController as SellerProductController;
use App\Http\Controllers\Api\ShippingController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Middleware\AuthJwt;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//route for customer
Route::post('register', [AuthController::class, 'customerRegister']);
Route::post('login', [AuthController::class, 'authenticate'])->name('customer.login');
Route::get('products', [ProductController::class, 'index'])->name('products.get');
Route::get('products/{id}', [ProductController::class, 'show']);
Route::get('category/{id}',[CategoryController::class,'show']);
Route::get('category', [CategoryController::class, 'index'])->name('customer.category.get');

Route::post('cost', [ShippingController::class, 'getListCosts']);
Route::get('province/{id?}',[ShippingController::class, 'getProvince']);
Route::get('city', [ShippingController::class, 'getListCity']);

Route::middleware([AuthJwt::class])->group(function(){
    Route::post('transaction', [TransactionController::class, 'store'])->name('transaction.post');
    Route::get('transaction/{id?}', [TransactionController::class,'index']);
    Route::post('logout', [AuthController::class, 'logout']);
});

//route for seller
Route::group(['prefix' => 'seller'], function() {
    Route::post('register', [AuthController::class,'sellerRegister'])->name('seller.register');
    Route::post('login', [AuthController::class, 'authenticate']);

    Route::middleware([AuthJwt::class])->group(function() {
        Route::post('logout', [AuthController::class, 'logout']);

        //seller
        Route::middleware('is_seller')->group(function() {
            //category
            Route::post('category', [CategoryController::class, 'store']);
            Route::delete('category/{id}', [CategoryController::class, 'destroy']);

            //products
            Route::post('products', [SellerProductController::class, 'store']);
            Route::post('products/{id}', [SellerProductController::class, 'update']);
            // Route::put('products/{id}', [SellerProductController::class,'update']); //doesnt work
            Route::delete('products/{id}', [SellerProductController::class, 'destroy']);
        });
    });
});
