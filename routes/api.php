<?php

use App\Http\Controllers\Api\MailController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('transaction', [TransactionController::class, 'store'])->name('transaction.post');
Route::get('products', [ProductController::class, 'index'])->name('products.get');
Route::get('send-mail', [MailController::class, 'sendinblue']);