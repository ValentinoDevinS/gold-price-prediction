<?php

use App\Http\Controllers\Api\V1\PredictionEvaluationController;
use Illuminate\Support\Facades\Route;

Route::prefix('prediction-evaluations')

    ->controller(
        PredictionEvaluationController::class
    )

    ->group(function () {

        Route::get(
            '/',
            'index'
        );

        Route::get(
            '/{uuid}',
            'show'
        );

        Route::post(
            '/predictions/{predictionUuid}',
            'evaluatePredictionResult'
        );

        Route::post(
            '/ensembles/{ensembleUuid}',
            'evaluateEnsembleResult'
        );

        Route::delete(
            '/{uuid}',
            'destroy'
        );

    });