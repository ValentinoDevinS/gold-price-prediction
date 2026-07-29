<?php

declare(strict_types=1);

namespace App\Services\Prediction;

use App\DTOs\Prediction\PredictionAgreementData;
use App\DTOs\Prediction\PredictionEnsembleData;
use App\DTOs\Prediction\PredictionData;
use App\Repositories\PredictionResultRepository;

final readonly class PredictionEnsembleService
{
    public function __construct(
        private PredictionResultRepository $repository,
    ) {
    }

    /**
     * Latest ensemble prediction.
     */
    public function latest(): ?PredictionEnsembleData
    {
        $predictions = $this->repository
            ->latestPredictionSet();

        if ($predictions->count() < 3) {
            return null;
        }

        $mapped = $predictions
            ->map(fn ($prediction) => PredictionData::fromModel($prediction));

        /** @var PredictionData|null $lstm */
        $lstm = $mapped->firstWhere('modelName', 'LSTM');

        /** @var PredictionData|null $cnn */
        $cnn = $mapped->firstWhere('modelName', 'CNN');

        /** @var PredictionData|null $ann */
        $ann = $mapped->firstWhere('modelName', 'ANN');

        if (
            $lstm === null ||
            $cnn === null ||
            $ann === null
        ) {
            return null;
        }

        return $this->build(
            $lstm,
            $cnn,
            $ann,
        );
    }

    /**
     * Build ensemble DTO.
     */
    private function build(
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
            $lstm->confidenceScore,
            $cnn->confidenceScore,
            $ann->confidenceScore,
        ]);

        $averagePrediction =
            array_sum($predictions) / count($predictions);

        $averageConfidence =
            count($confidences) > 0
                ? array_sum($confidences) / count($confidences)
                : null;

        $minimum = min($predictions);

        $maximum = max($predictions);

        $spread = $maximum - $minimum;

        $agreement = $this->agreement(
            $lstm,
            $cnn,
            $ann,
        );

        return new PredictionEnsembleData(

            lstm: $lstm,

            cnn: $cnn,

            ann: $ann,

            averagePrediction: $averagePrediction,

            averageConfidence: $averageConfidence,

            minimumPrediction: $minimum,

            maximumPrediction: $maximum,

            predictionSpread: $spread,

            displayAveragePrediction:
                number_format($averagePrediction, 2),

            displayAverageConfidence:
                $averageConfidence !== null
                    ? number_format(
                        $averageConfidence * 100,
                        2
                    ) . ' %'
                    : '-',

            consensus: $agreement->consensus,
        );
    }

    /**
     * Agreement analysis.
     */
    private function agreement(
        PredictionData $lstm,
        PredictionData $cnn,
        PredictionData $ann,
    ): PredictionAgreementData {

        $lstmVsCnn =
            abs($lstm->predictedPrice - $cnn->predictedPrice);

        $lstmVsAnn =
            abs($lstm->predictedPrice - $ann->predictedPrice);

        $cnnVsAnn =
            abs($cnn->predictedPrice - $ann->predictedPrice);

        $spread = max([
                $lstm->predictedPrice,
                $cnn->predictedPrice,
                $ann->predictedPrice,
            ]) -
            min([
                $lstm->predictedPrice,
                $cnn->predictedPrice,
                $ann->predictedPrice,
            ]);

        $averageDifference = (
            $lstmVsCnn +
            $lstmVsAnn +
            $cnnVsAnn
        ) / 3;

        $consensus = match (true) {
            $spread <= 1 => 'HIGH',
            $spread <= 5 => 'MEDIUM',
            default => 'LOW',
        };

        return new PredictionAgreementData(

            lstmVsCnn: $lstmVsCnn,

            lstmVsAnn: $lstmVsAnn,

            cnnVsAnn: $cnnVsAnn,

            spread: $spread,

            averageDifference: $averageDifference,

            consensus: $consensus,

            displaySpread:
                number_format($spread, 2),

            displayAverageDifference:
                number_format(
                    $averageDifference,
                    2,
                ),

        );
    }
}