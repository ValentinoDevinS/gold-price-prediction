<?php

use App\Http\Controllers\Api\V1\ModelStatisticController;
use Illuminate\Support\Facades\Route;

Route::prefix('model-statistics')
    ->name('model-statistics.')
    ->group(function () {

        Route::get(
            '/',
            [ModelStatisticController::class, 'index']
        )->name('index');

        Route::get(
            '/leaderboard',
            [ModelStatisticController::class, 'leaderboard']
        )->name('leaderboard');

        Route::get(
            '/dashboard',
            [ModelStatisticController::class, 'dashboard']
        )->name('dashboard');

        Route::post(
            '/actions/refresh',
            [ModelStatisticController::class, 'refresh']
        )->name('refresh');

        Route::get(
            '/{uuid}',
            [ModelStatisticController::class, 'show']
        )->name('show');

        Route::delete(
            '/{uuid}',
            [ModelStatisticController::class, 'destroy']
        )->name('destroy');

    });