<?php

declare(strict_types=1);

use App\Http\Controllers\FullArticle\FullArticleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->prefix('full-articles')
    ->name('full-articles.')
    ->group(function (): void {

        Route::get(
            '/',
            [FullArticleController::class, 'index'],
        )->name('index');

        Route::get(
            '/{uuid}',
            [FullArticleController::class, 'show'],
        )->name('show');

    });