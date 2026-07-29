<?php

declare(strict_types=1);

namespace App\Services\FeatureEngineering;

use App\Support\Table\Table;
use App\Support\Table\Column;
use App\Support\Table\Action;

final readonly class FeatureEngineeringTableService
{
    public function __construct(
        private FeatureEngineeringQueryService $queryService,
    ) {
    }

    /**
     * Build feature engineering table.
     */
    public function getTable(
        int $perPage = 20,
    ): Table {

        return new Table(

            rows: $this->queryService->paginate(
                perPage: $perPage,
            ),

            columns: [

                Column::make(
                    label: 'Article',
                    field: 'articleTitle',
                ),

                Column::make(
                    label: 'Average Sentiment',
                    field: 'averageSentiment',
                ),

                Column::make(
                    label: 'Word Count',
                    field: 'wordCount',
                ),

                Column::make(
                    label: 'Prediction',
                    field: 'predictionStatus',
                ),

                Column::make(
                    label: 'Version',
                    field: 'featureVersion',
                ),

                Column::make(
                    label: 'Generated',
                    field: 'displayDate',
                ),

            ],

            actions: [

                Action::make(
                    label: 'View',
                    route: 'feature-engineering.show',
                    parameter: 'uuid',
                ),

            ],

            emptyStateTitle:
                'No feature snapshots found.',

            emptyStateDescription:
                'Run the feature engineering pipeline to generate feature snapshots.',

        );
    }
}