<?php

use App\Http\Controllers\Api\V1\SentimentAnalysisController;
use Illuminate\Support\Facades\Route;

Route::apiResource(
    'sentiment-analyses',
    SentimentAnalysisController::class
)
->parameters([
    'sentiment-analyses' => 'uuid',
])
->names('sentiment-analyses');