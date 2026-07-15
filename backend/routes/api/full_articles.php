<?php

use App\Http\Controllers\Api\V1\FullArticleController;
use Illuminate\Support\Facades\Route;

Route::apiResource(
    'full-articles',
    FullArticleController::class
)
->parameters([
    'full-articles' => 'uuid',
])
->names('full-articles');