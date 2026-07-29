<?php

declare(strict_types=1);

namespace App\Services\Prediction;

use App\DTOs\Prediction\PredictionData;
use App\DTOs\Prediction\PredictionTableRowData;
use App\Models\PredictionResult;
use Illuminate\Database\Eloquent\Collection;

final readonly class PredictionSetBuilder
{
    public function __construct(
        private PredictionEnsembleCalculator $calculator,
    ) {
    }

    /**
     * Build a prediction set from one feature snapshot.
     *
     * @param Collection<int, PredictionResult> $predictions
     */
    public function build(
        Collection $predictions,
    ): PredictionTableRowData {

        $lstmModel = $predictions->firstWhere(
            'model_name',
            'LSTM',
        );

        $cnnModel = $predictions->firstWhere(
            'model_name',
            'CNN',
        );

        $annModel = $predictions->firstWhere(
            'model_name',
            'ANN',
        );

        $lstm = $lstmModel
            ? PredictionData::fromModel($lstmModel)
            : null;

        $cnn = $cnnModel
            ? PredictionData::fromModel($cnnModel)
            : null;

        $ann = $annModel
            ? PredictionData::fromModel($annModel)
            : null;

        $isComplete = $lstm !== null
            && $cnn !== null
            && $ann !== null;

        if (! $isComplete) {

            return new PredictionTableRowData(

                featureSnapshotUuid: (string) optional(
                    $predictions->first()?->featureSnapshot
                )->uuid,

                featureSnapshotId: (int) $predictions->first()->feature_snapshot_id,

                predictionDate: (string) $predictions->first()->prediction_date,

                lstm: $lstm,

                cnn: $cnn,

                ann: $ann,

                ensemblePrediction: 0,

                ensembleConfidence: null,

                displayEnsemblePrediction: '-',

                displayEnsembleConfidence: '-',

                agreement: null,

                consensus: 'Incomplete',

                isComplete: false,

                canEvaluate: false,
            );
        }

        $ensemble = $this->calculator->calculate(
            $lstm,
            $cnn,
            $ann,
        );

        return new PredictionTableRowData(

            featureSnapshotUuid: (string) optional(
                $predictions->first()?->featureSnapshot
            )->uuid,

            featureSnapshotId: (int) $predictions->first()->feature_snapshot_id,

            predictionDate: (string) $predictions->first()->prediction_date,

            lstm: $lstm,

            cnn: $cnn,

            ann: $ann,

            ensemblePrediction: $ensemble->averagePrediction,

            ensembleConfidence: $ensemble->averageConfidence,

            displayEnsemblePrediction: $ensemble->displayAveragePrediction,

            displayEnsembleConfidence: $ensemble->displayAverageConfidence,

            agreement: $ensemble->agreement,

            consensus: $ensemble->consensus,

            isComplete: true,

            canEvaluate: true,
        );
    }
}