<?php

declare(strict_types=1);

namespace App\Services\Prediction;

use App\DTOs\Prediction\PredictionDashboardData;

final readonly class PredictionDashboardService
{
    public function __construct(
        private PredictionStatisticService $statisticService,
        private PredictionEnsembleService $ensembleService,
        private PredictionTableService $tableService,
    ) {
    }

    /**
     * Get prediction dashboard.
     */
    public function getDashboard(
        array $filters = [],
        ?string $search = null,
        ?string $sort = null,
        ?string $direction = null,
        int $perPage = 20,
    ): PredictionDashboardData {

        return new PredictionDashboardData(

            statistics: $this->statisticService->getStatistics(),

            ensemble: $this->ensembleService->latest(),

            table: $this->tableService->getTable(
                filters: $filters,
                search: $search,
                sort: $sort,
                direction: $direction,
                perPage: $perPage,
            ),

        );
    }
}