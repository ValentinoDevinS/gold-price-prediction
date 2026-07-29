<?php

declare(strict_types=1);

namespace App\Services\Prediction;

use App\DTOs\Prediction\PredictionAgreementData;
use App\DTOs\Prediction\PredictionData;
use App\DTOs\Prediction\PredictionEnsembleData;

final class PredictionEnsembleCalculator
{
    public function calculate(
        PredictionData $lstm,
        PredictionData $cnn,
        PredictionData $ann,
    ): PredictionEnsembleData {

        $predictions = [
            $lstm->predictedPrice,
            $cnn->predictedPrice,
            $ann->predictedPrice,
        ];

        $confidences = array_filter([
            $lstm->confidence,
            $cnn->confidence,
            $ann->confidence,
        ], static fn ($value) => $value !== null);

        $averagePrediction = array_sum($predictions) / count($predictions);

        $averageConfidence = empty($confidences)
            ? null
            : array_sum($confidences) / count($confidences);

        $minimumPrediction = min($predictions);

        $maximumPrediction = max($predictions);

        $spread = $maximumPrediction - $minimumPrediction;

        $agreement = new PredictionAgreementData(

            lstmVsCnn: abs(
                $lstm->predictedPrice - $cnn->predictedPrice
            ),

            lstmVsAnn: abs(
                $lstm->predictedPrice - $ann->predictedPrice
            ),

            cnnVsAnn: abs(
                $cnn->predictedPrice - $ann->predictedPrice
            ),

            spread: $spread,

            averageDifference: (
                abs($lstm->predictedPrice - $cnn->predictedPrice)
                + abs($lstm->predictedPrice - $ann->predictedPrice)
                + abs($cnn->predictedPrice - $ann->predictedPrice)
            ) / 3,

            consensus: $this->determineConsensus($spread),

            displaySpread: number_format($spread, 2),

            displayAverageDifference: number_format(
                (
                    abs($lstm->predictedPrice - $cnn->predictedPrice)
                    + abs($lstm->predictedPrice - $ann->predictedPrice)
                    + abs($cnn->predictedPrice - $ann->predictedPrice)
                ) / 3,
                2
            ),
        );

        return new PredictionEnsembleData(

            lstm: $lstm,

            cnn: $cnn,

            ann: $ann,

            averagePrediction: $averagePrediction,

            averageConfidence: $averageConfidence,

            minimumPrediction: $minimumPrediction,

            maximumPrediction: $maximumPrediction,

            predictionSpread: $spread,

            agreement: $agreement,

            displayAveragePrediction: number_format(
                $averagePrediction,
                2
            ),

            displayAverageConfidence: $averageConfidence === null
                ? '-'
                : number_format($averageConfidence, 2) . '%',

            consensus: $agreement->consensus,
        );
    }

    private function determineConsensus(
        float $spread,
    ): string {

        return match (true) {

            $spread <= 2 => 'High',

            $spread <= 5 => 'Medium',

            default => 'Low',

        };
    }
}