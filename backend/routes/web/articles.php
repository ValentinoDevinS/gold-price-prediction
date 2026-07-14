<?php

use App\Http\Controllers\Web\ArticleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')

    ->group(function () {

        Route::get(
            '/articles',
            [ArticleController::class,'index']
        )->name('articles.index');

        Route::get(
            '/articles/{article}',
            [ArticleController::class,'show']
        )->name('articles.show');

    });