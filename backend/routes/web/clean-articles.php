<?php

declare(strict_types=1);

use App\Http\Controllers\CleanArticle\CleanArticleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (): void {

    Route::prefix('clean-articles')
        ->name('clean-articles.')
        ->controller(CleanArticleController::class)
        ->group(function (): void {

            Route::get(
                '/',
                'index'
            )->name('index');

            Route::get(
                '/{uuid}',
                'show'
            )->name('show');

        });

});