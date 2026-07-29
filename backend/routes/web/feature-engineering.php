<?php

declare(strict_types=1);

use App\Http\Controllers\FeatureEngineering\FeatureEngineeringController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (): void {

    Route::prefix('feature-engineering')
        ->name('feature-engineering.')
        ->controller(FeatureEngineeringController::class)
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