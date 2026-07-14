<?php

use App\Http\Controllers\Api\V1\ArticleController;
use Illuminate\Support\Facades\Route;

Route::apiResource(
    'articles',
    ArticleController::class
)
    ->parameters([
        'articles' => 'uuid',
    ])
    ->names('articles');