<?php

use App\Http\Controllers\Api\V1\ModelStatisticHistoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('model-statistic-histories')
    ->name('model-statistic-histories.')
    ->group(function () {

        Route::get(
            '/',
            [ModelStatisticHistoryController::class, 'index']
        )->name('index');

        Route::get(
            '/{uuid}',
            [ModelStatisticHistoryController::class, 'show']
        )->name('show');

        Route::delete(
            '/{uuid}',
            [ModelStatisticHistoryController::class, 'destroy']
        )->name('destroy');

    });