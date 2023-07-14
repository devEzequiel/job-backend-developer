<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\Api\Product\ProductController::class)
    ->name('products.')
    ->prefix('products')
    ->group(function () {
        Route::get('/', 'all')->name('list');
        Route::get('/{id}', 'show')->name('detail');
        Route::post('/', 'store')->name('create');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('delete');
    });
