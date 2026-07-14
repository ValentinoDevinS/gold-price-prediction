<?php

use App\Http\Controllers\Api\V1\ArticleController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->prefix('ai')
    ->group(function () {

        Route::post(
            '/articles',
            [ArticleController::class, 'store']
        );

    });