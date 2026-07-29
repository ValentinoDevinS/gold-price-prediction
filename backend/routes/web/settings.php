<?php

declare(strict_types=1);

use App\Http\Controllers\Settings\SettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('settings')
    ->name('settings.')
    ->group(function (): void {

        Route::get(
            '/',
            [SettingController::class, 'index'],
        )->name('index');

        Route::put(
            '/{uuid}',
            [SettingController::class, 'update'],
        )->name('update');

        Route::put(
            '/bulk',
            [SettingController::class, 'bulkUpdate'],
        )->name('bulk-update');

    });