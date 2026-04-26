<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ProductController::class);
Route::apiResource('orders', OrderController::class);
Route::apiResource('customers', CustomerController::class);


Route::post('orders/{order}/customers/{customer}', [OrderController::class, 'attachCustomer']);
Route::post('products/{product}/orders/{order}', [ProductController::class, 'attachOrder']);
Route::post('orders/{order}/products/{product}', [OrderController::class, 'attachProduct']);


Route::delete('orders/{order}/customers/{customer}', [OrderController::class, 'detachCustomer']);
Route::delete('products/{product}/orders/{order}', [ProductController::class, 'detachOrder']);
Route::delete('orders/{order}/products/{product}', [OrderController::class, 'detachProduct']);
