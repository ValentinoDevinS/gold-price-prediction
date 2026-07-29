<?php

declare(strict_types=1);

use App\Http\Controllers\GoldPrice\GoldPriceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->prefix('gold-prices')
    ->name('gold-prices.')
    ->group(function (): void {

        Route::get(
            '/',
            [GoldPriceController::class, 'index'],
        )->name('index');

        Route::get(
            '/{date}',
            [GoldPriceController::class, 'show'],
        )->name('show');

    });