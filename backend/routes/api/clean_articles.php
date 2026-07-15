<?php

use App\Http\Controllers\Api\V1\CleanArticleController;
use Illuminate\Support\Facades\Route;

Route::apiResource(
    'clean-articles',
    CleanArticleController::class
)
->parameters([
    'clean-articles' => 'uuid',
])
->names('clean-articles');