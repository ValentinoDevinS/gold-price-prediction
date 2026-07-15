<?php

use App\Http\Controllers\Web\FullArticleController;
use Illuminate\Support\Facades\Route;

Route::get(
    'full-articles',
    [FullArticleController::class, 'index']
)->name('full-articles.index');

Route::get(
    'full-articles/{fullArticle}',
    [FullArticleController::class, 'show']
)->name('full-articles.show');