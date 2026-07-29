<?php

declare(strict_types=1);

namespace App\DTOs\Prediction;

final readonly class PredictionTableRowData
{
    public function __construct(

        /*
        |--------------------------------------------------------------------------
        | Identity
        |--------------------------------------------------------------------------
        */

        public string $featureSnapshotUuid,

        public int $featureSnapshotId,

        public string $predictionDate,

        /*
        |--------------------------------------------------------------------------
        | Individual Models
        |--------------------------------------------------------------------------
        */

        public ?PredictionData $lstm,

        public ?PredictionData $cnn,

        public ?PredictionData $ann,

        /*
        |--------------------------------------------------------------------------
        | Ensemble
        |--------------------------------------------------------------------------
        */

        public float $ensemblePrediction,

        public ?float $ensembleConfidence,

        public string $displayEnsemblePrediction,

        public string $displayEnsembleConfidence,

        /*
        |--------------------------------------------------------------------------
        | Agreement
        |--------------------------------------------------------------------------
        */

        public PredictionAgreementData $agreement,

        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        public string $consensus,

        public bool $isComplete,

        public bool $canEvaluate,

    ) {
    }
}