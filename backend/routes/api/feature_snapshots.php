<?php

use App\Http\Controllers\Api\V1\FeatureSnapshotController;
use Illuminate\Support\Facades\Route;

Route::apiResource(
    'feature-snapshots',
    FeatureSnapshotController::class
)
->parameters([
    'feature-snapshots' => 'uuid',
])
->names('feature-snapshots');