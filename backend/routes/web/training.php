<?php

declare(strict_types=1);

use App\Http\Controllers\Training\TrainingController;
use Illuminate\Support\Facades\Route;

Route::prefix('training')
    ->name('training.')
    ->controller(TrainingController::class)
    ->group(function () {

        Route::get(
            '/',
            'index',
        )->name('index');

    });