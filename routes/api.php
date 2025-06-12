<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth;

Route::prefix("/auth")->group(function () {
    Route::post('/login', [Auth\AuthController::class, 'login']);
    Route::middleware("auth:sanctum")->get('/me', [Auth\AuthController::class, 'me']);
});

Route::apiResource('/products', App\Http\Controllers\API\ProductController::class);
Route::apiResource('/plans', App\Http\Controllers\API\PlanController::class);


Route::middleware("auth:sanctum")->group(function () {
    Route::apiResource('/cards', App\Http\Controllers\API\CardController::class);
    Route::apiResource('/carts', App\Http\Controllers\API\Order\CartController::class);
    Route::prefix("/cards")->group(function () {
        Route::post('/validate', [App\Http\Controllers\API\CardController::class, "validate"]);
    });
    Route::apiResource('/subscribes', App\Http\Controllers\API\SubscribeController::class);
    Route::get('/orders/checkout', [App\Http\Controllers\API\Order\OrderController::class, "checkout"]);
    Route::post('/orders/payment-verify/{id}', [App\Http\Controllers\API\Order\OrderController::class, "payment_verify"]);
    Route::apiResource('/orders', App\Http\Controllers\API\Order\OrderController::class);
});


Route::apiResource('/product_bundles', App\Http\Controllers\API\Order\ProductBundleController::class);

Route::apiResource('/product_bundle_items', App\Http\Controllers\API\Order\ProductBundleItemController::class);

Route::apiResource('/order_items', App\Http\Controllers\API\Order\OrderItemController::class);

Route::apiResource('/promocodes', App\Http\Controllers\API\PromocodeController::class);
