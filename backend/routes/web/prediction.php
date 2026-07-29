<?php

declare(strict_types=1);

use App\Http\Controllers\Prediction\PredictionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (): void {

    Route::prefix('prediction')
        ->name('prediction.')
        ->controller(PredictionController::class)
        ->group(function (): void {

            Route::get(
                '/',
                'index',
            )->name('index');

            Route::get(
                '/{uuid}',
                'show',
            )->name('show');

        });

});