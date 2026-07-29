<?php

declare(strict_types=1);

namespace App\DTOs\Prediction;

final readonly class PredictionAgreementData
{
    public function __construct(

        /*
        |--------------------------------------------------------------------------
        | Pairwise Differences
        |--------------------------------------------------------------------------
        */

        public float $lstmVsCnn,

        public float $lstmVsAnn,

        public float $cnnVsAnn,

        /*
        |--------------------------------------------------------------------------
        | Overall Agreement
        |--------------------------------------------------------------------------
        */

        public float $spread,

        public float $averageDifference,

        public string $consensus,

        /*
        |--------------------------------------------------------------------------
        | Display
        |--------------------------------------------------------------------------
        */

        public string $displaySpread,

        public string $displayAverageDifference,

    ) {
    }
}