<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1/ai')
    ->as('api.v1.')
    ->group(function () {

        require __DIR__.'/api/articles.php';
        // require __DIR__.'/api/full_articles.php';
        // require __DIR__.'/api/predictions.php';
        // require __DIR__.'/api/ml_models.php';
    });