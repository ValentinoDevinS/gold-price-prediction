<?php

declare(strict_types=1);

namespace App\DTOs\Prediction;

final readonly class PredictionEnsembleData
{
    public function __construct(

        /*
        |--------------------------------------------------------------------------
        | Individual Predictions
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

        public float $averagePrediction,

        public ?float $averageConfidence,

        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        public float $minimumPrediction,

        public float $maximumPrediction,

        public float $predictionSpread,

        /*
        |--------------------------------------------------------------------------
        | Display
        |--------------------------------------------------------------------------
        */

        public string $displayAveragePrediction,

        public string $displayAverageConfidence,

        public string $consensus,

    ) {
    }
}