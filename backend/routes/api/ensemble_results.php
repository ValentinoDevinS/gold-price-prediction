<?php

use App\Http\Controllers\Api\V1\EnsembleResultController;
use Illuminate\Support\Facades\Route;

Route::prefix('ensemble-results')
    ->group(function () {

        Route::get(
            '/',
            [EnsembleResultController::class, 'index']
        );

        Route::get(
            '/{uuid}',
            [EnsembleResultController::class, 'show']
        );

        Route::post(
            '/generate/{featureSnapshotUuid}',
            [EnsembleResultController::class, 'generate']
        );

        Route::delete(
            '/{uuid}',
            [EnsembleResultController::class, 'destroy']
        );

    });