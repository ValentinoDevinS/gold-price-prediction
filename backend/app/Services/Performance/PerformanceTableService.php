<?php

declare(strict_types=1);

namespace App\Services\Performance;

use App\Support\Table\Table;
use App\Support\Table\TableColumn;
use App\Support\Table\TableAction;

final readonly class PerformanceTableService
{
    public function __construct(
        private PerformanceQueryService $queryService,
    ) {
    }

    public function getTable(
        array $filters = [],
        ?string $search = null,
        ?string $sort = null,
        ?string $direction = null,
        int $perPage = 20,
    ): Table {

        $rows = $this->queryService->paginate(
            filters: $filters,
            search: $search,
            sort: $sort,
            direction: $direction,
            perPage: $perPage,
        );

        return new Table(

            columns: [

                new TableColumn(
                    label: 'Article',
                    key: 'articleTitle',
                    sortable: false,
                ),

                new TableColumn(
                    label: 'Model',
                    key: 'modelLabel',
                    sortable: true,
                ),

                new TableColumn(
                    label: 'Actual Price',
                    key: 'actualPrice',
                    sortable: true,
                ),

                new TableColumn(
                    label: 'Predicted Price',
                    key: 'predictedPrice',
                    sortable: true,
                ),

                new TableColumn(
                    label: 'MAPE (%)',
                    key: 'percentageError',
                    sortable: true,
                ),

                new TableColumn(
                    label: 'Grade',
                    key: 'performanceGrade',
                    sortable: false,
                ),

                new TableColumn(
                    label: 'Evaluation Date',
                    key: 'displayEvaluatedAt',
                    sortable: true,
                ),

            ],

            rows: $rows,

            actions: [

                new TableAction(

                    label: 'View',

                    route: 'performance.show',

                    parameter: 'uuid',

                ),

            ],

            emptyStateTitle: 'No Performance Data',

            emptyStateDescription:
                'Run prediction evaluation to generate performance metrics.',

        );
    }
}