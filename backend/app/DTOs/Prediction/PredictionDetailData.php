<?php

declare(strict_types=1);

namespace App\DTOs\Prediction;

use App\DTOs\FeatureEngineering\FeatureEngineeringData;
use App\DTOs\Performance\PredictionEvaluationData;

final readonly class PredictionDetailData
{
    public function __construct(

        /*
        |--------------------------------------------------------------------------
        | Prediction Set
        |--------------------------------------------------------------------------
        */

        public PredictionTableRowData $prediction,

        /*
        |--------------------------------------------------------------------------
        | Feature Snapshot
        |--------------------------------------------------------------------------
        */

        public FeatureEngineeringData $featureSnapshot,

        /*
        |--------------------------------------------------------------------------
        | Evaluation
        |--------------------------------------------------------------------------
        */

        public ?PredictionEvaluationData $evaluation,

    ) {
    }
}