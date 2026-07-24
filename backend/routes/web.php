<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Article\FullArticleController;
use App\Http\Controllers\CleanArticle\CleanArticleController;
use App\Http\Controllers\SentimentAnalysis\SentimentAnalysisController;
use App\Http\Controllers\FeatureSnapshot\FeatureSnapshotController;
use App\Http\Controllers\PredictionResult\PredictionResultController;
use App\Http\Controllers\PredictionEvaluation\PredictionEvaluationController;
use App\Http\Controllers\EnsembleResult\EnsembleResultController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('articles')
        ->name('articles.')
        ->controller(ArticleController::class)
        ->group(function () {

            Route::get('/', 'index')
                ->name('index');

            Route::get('/{uuid}', 'show')
                ->name('show');

        });

    Route::prefix('full-articles')
        ->name('full-articles.')
        ->controller(FullArticleController::class)
        ->group(function () {

            Route::get('/', 'index')
                ->name('index');

            Route::get('/{uuid}', 'show')
                ->name('show');

        });

    Route::prefix('clean-articles')
        ->name('clean-articles.')
        ->controller(CleanArticleController::class)
        ->group(function () {

            Route::get('/', 'index')
                ->name('index');

            Route::get('/{uuid}', 'show')
                ->name('show');

        });

    Route::prefix('sentiment-analyses')
        ->name('sentiment-analyses.')
        ->controller(SentimentAnalysisController::class)
        ->group(function () {

            Route::get('/', 'index')
                ->name('index');

            Route::get('/{uuid}', 'show')
                ->name('show');

        });

    Route::prefix('feature-snapshots')
        ->name('feature-snapshots.')
        ->controller(FeatureSnapshotController::class)
        ->group(function () {

            Route::get('/', 'index')
                ->name('index');

            Route::get('/{uuid}', 'show')
                ->name('show');

        });

    Route::prefix('prediction-results')
        ->name('prediction-results.')
        ->controller(PredictionResultController::class)
        ->group(function () {

            Route::get('/', 'index')
                ->name('index');

            Route::get('/{uuid}', 'show')
                ->name('show');

        });

    Route::prefix('prediction-evaluations')
        ->name('prediction-evaluations.')
        ->controller(PredictionEvaluationController::class)
        ->group(function () {

            Route::get('/', 'index')
                ->name('index');

            Route::get('/{uuid}', 'show')
                ->name('show');

        });

    Route::prefix('ensemble-results')
        ->name('ensemble-results.')
        ->controller(EnsembleResultController::class)
        ->group(function () {

            Route::get('/', 'index')
                ->name('index');

            Route::get('/{uuid}', 'show')
                ->name('show');

        });
});

require __DIR__.'/auth.php';
