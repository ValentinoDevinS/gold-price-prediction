<?php

declare(strict_types=1);

use App\Http\Controllers\Performance\PerformanceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (): void {

    Route::prefix('performance')
        ->name('performance.')
        ->controller(PerformanceController::class)
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