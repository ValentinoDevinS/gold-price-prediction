<?php

use App\Http\Controllers\Api\V1\PredictionResultController;
use Illuminate\Support\Facades\Route;

Route::apiResource(
    'prediction-results',
    PredictionResultController::class
)
->parameters([
    'prediction-results' => 'uuid',
])
->names('prediction-results');