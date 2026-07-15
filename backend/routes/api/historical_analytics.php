<?php

use App\Http\Controllers\Api\V1\HistoricalAnalyticsController;
use Illuminate\Support\Facades\Route;

Route::prefix('analytics')
    ->name('analytics.')
    ->group(function () {

        Route::get(
            '/dashboard',
            [HistoricalAnalyticsController::class, 'index']
        )->name('dashboard');

        Route::get(
            '/summary',
            [HistoricalAnalyticsController::class, 'summary']
        )->name('summary');

        Route::get(
            '/trend',
            [HistoricalAnalyticsController::class, 'trend']
        )->name('trend');

        Route::get(
            '/comparison',
            [HistoricalAnalyticsController::class, 'comparison']
        )->name('comparison');

    });