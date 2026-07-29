<?php

declare(strict_types=1);

namespace App\DTOs\Prediction;

use App\Support\Table\Table;

final readonly class PredictionDashboardData
{
    public function __construct(

        /*
        |--------------------------------------------------------------------------
        | Dashboard Statistics
        |--------------------------------------------------------------------------
        */

        public array $statistics,

        /*
        |--------------------------------------------------------------------------
        | Ensemble Prediction
        |--------------------------------------------------------------------------
        */

        public ?PredictionEnsembleData $ensemble,

        /*
        |--------------------------------------------------------------------------
        | Prediction History
        |--------------------------------------------------------------------------
        */

        public Table $table,

    ) {
    }
}