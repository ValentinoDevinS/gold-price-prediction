<?php

use App\Http\Controllers\Api\V1\ArticleController;
use Illuminate\Support\Facades\Route;

Route::prefix('ai')
    ->group(function () {

        Route::get(
            '/articles',
            [ArticleController::class,'index']
        )->name('api.v1.ai.articles.index');

        Route::post(
            '/articles',
            [ArticleController::class,'store']
        )->name('api.v1.ai.articles.store');

        Route::get(
            '/articles/{article}',
            [ArticleController::class,'show']
        )->name('api.v1.ai.articles.show');

    });