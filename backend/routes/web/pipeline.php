<?php

declare(strict_types=1);

use App\Http\Controllers\Pipeline\PipelineController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (): void {

    Route::prefix('pipeline')
        ->name('pipeline.')
        ->controller(PipelineController::class)
        ->group(function (): void {

            Route::get(
                '/',
                'index'
            )->name('index');

        });

});