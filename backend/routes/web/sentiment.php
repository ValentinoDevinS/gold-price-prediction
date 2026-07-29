<?php

declare(strict_types=1);

use App\Http\Controllers\SentimentAnalysis\SentimentAnalysisController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (): void {

    Route::prefix('sentiment')
        ->name('sentiment.')
        ->controller(SentimentAnalysisController::class)
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