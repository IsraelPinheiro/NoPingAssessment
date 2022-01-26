<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\SaleController;
use App\Http\Controllers\API\SupplierController;
use App\Http\Controllers\API\UserController;
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

Route::name('api.')->group(function(){
    //Auth
    Route::post('login', [AuthController::class, 'signin'])->name('login');
    Route::middleware('auth:sanctum')->group(function(){
        //Customers
        Route::get('customers/{customer}/purchases', [CustomerController::class,'getPurchases'])->name('customers.purchases');
        Route::resource('customers', CustomerController::class)->except(['create','edit']);
        //Products
        Route::get('products/{product}/supplier', [ProductController::class,'getSupplier'])->name('products.supplier');
        Route::resource('products', ProductController::class)->except(['create','edit']);
        //Sales
        Route::get('sales/{sale}/customer', [SaleController::class,'getCustomer'])->name('sales.customer');
        Route::get('sales/{sale}/products', [SaleController::class,'getProducts'])->name('sales.products.list');
        Route::post('sales/{sale}/products', [SaleController::class,'addProduct'])->name('sales.products.add');
        Route::delete('sales/{sale}/products', [SaleController::class,'removeProduct'])->name('sales.products.remove');
        Route::post('sales/{sale}/close', [SaleController::class,'closeSale'])->name('sales.close');
        Route::resource('sales', SaleController::class)->except(['create','edit']);
        //Supplisers
        Route::get('suppliers/{supplier}/products', [SupplierController::class,'getProducts'])->name('suppliers.products.list');
        Route::resource('suppliers', SupplierController::class)->except(['create','edit']);
        //Users
        Route::post('register', [UserController::class, 'store'])->name('register');
        Route::get('users/{user}/tokens', [UserController::class, 'getTokens'])->name('users.tokens');
        Route::resource('users', UserController::class)->except(['create','edit']);
    });
});
