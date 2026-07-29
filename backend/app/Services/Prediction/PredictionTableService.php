<?php

declare(strict_types=1);

namespace App\Services\Prediction;

use App\Support\Table\Actions\LinkAction;
use App\Support\Table\Columns\TextColumn;
use App\Support\Table\Table;

final readonly class PredictionTableService
{
    public function __construct(
        private PredictionQueryService $queryService,
    ) {
    }

    public function getTable(
        array $filters = [],
        ?string $search = null,
        ?string $sort = null,
        ?string $direction = null,
        int $perPage = 20,
    ): Table {

        return new Table(

            rows: $this->queryService->paginate(
                filters: $filters,
                search: $search,
                sort: $sort,
                direction: $direction,
                perPage: $perPage,
            ),

            columns: [

                TextColumn::make(
                    key: 'predictionDate',
                    label: 'Prediction Date',
                ),

                TextColumn::make(
                    key: 'lstm.displayPrediction',
                    label: 'LSTM',
                ),

                TextColumn::make(
                    key: 'cnn.displayPrediction',
                    label: 'CNN',
                ),

                TextColumn::make(
                    key: 'ann.displayPrediction',
                    label: 'ANN',
                ),

                TextColumn::make(
                    key: 'displayEnsemblePrediction',
                    label: 'Ensemble',
                ),

                TextColumn::make(
                    key: 'consensus',
                    label: 'Consensus',
                ),

            ],

            actions: [

                LinkAction::make(
                    label: 'View',
                    route: 'prediction.show',
                    parameter: 'featureSnapshotUuid',
                ),

            ],

            emptyStateTitle: 'No prediction results found.',

            emptyStateDescription:
                'Run the prediction pipeline to generate prediction results.',

        );
    }
}