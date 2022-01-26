<?php

use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\SaleController;
use App\Http\Controllers\API\SupplierController;
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

Route::name('api.')->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('products', ProductController::class);
    Route::post('sales/{sale}/products', [SaleController::class,'addProduct']);
    Route::delete('sales/{sale}/products', [SaleController::class,'removeProduct']);
    Route::post('sales/{sale}/close', [SaleController::class,'closeSale']);
    Route::resource('sales', SaleController::class);
    Route::resource('suppliers', SupplierController::class);
});
