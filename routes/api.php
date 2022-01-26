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
    //Customers
    Route::resource('customers', CustomerController::class);
    //Products
    Route::get('products/{product}/supplier', [ProductController::class,'getSupplier']);
    Route::resource('products', ProductController::class);
    //Sales
    Route::get('sales/{sale}/customer', [SaleController::class,'getCustomer']);
    Route::get('sales/{sale}/products', [SaleController::class,'getProducts']);
    Route::post('sales/{sale}/products', [SaleController::class,'addProduct']);
    Route::delete('sales/{sale}/products', [SaleController::class,'removeProduct']);
    Route::post('sales/{sale}/close', [SaleController::class,'closeSale']);
    Route::resource('sales', SaleController::class);
    //Supplisers
    Route::get('suppliers/{supplier}/products', [SupplierController::class,'getProducts']);
    Route::resource('suppliers', SupplierController::class);
});
