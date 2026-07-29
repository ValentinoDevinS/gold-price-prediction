<?php

declare(strict_types=1);

use App\Http\Controllers\Article\ArticleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->prefix('articles')
    ->name('articles.')
    ->group(function (): void {

        Route::get(
            '/',
            [ArticleController::class, 'index'],
        )->name('index');

        Route::get(
            '/{uuid}',
            [ArticleController::class, 'show'],
        )->name('show');

    });