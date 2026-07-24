<?php

declare(strict_types=1);

use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

Route::controller(DashboardController::class)
    ->group(function () {

        Route::get('/', 'index')
            ->name('dashboard');

    });