<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\V1\Orders\IndexController;
use App\Http\Controllers\API\V1\Orders\StoreController;

Route::prefix('v1')->name('v1:')->group(function () {
    Route::prefix('orders')->name('orders:')->group(function () {
        Route::get('/', IndexController::class)->name('index');
        Route::post('/', StoreController::class)->name('store');
    });
});
