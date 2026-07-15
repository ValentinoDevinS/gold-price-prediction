<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1/ai')
    ->as('api.v1.')
    ->group(function () {

        require __DIR__.'/api/articles.php';

        require __DIR__.'/api/full_articles.php';

        require __DIR__.'/api/clean_articles.php';

        require __DIR__.'/api/sentiment_analyses.php';

        require __DIR__.'/api/feature_snapshots.php';

        require __DIR__.'/api/prediction_results.php';

        require __DIR__.'/api/ensemble_results.php';

        require __DIR__.'/api/prediction_evaluations.php';

        require __DIR__.'/api/model_statistics.php';

        
    });