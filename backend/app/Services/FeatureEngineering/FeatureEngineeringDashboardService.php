<?php

declare(strict_types=1);

namespace App\Services\FeatureEngineering;

use App\DTOs\FeatureEngineering\FeatureEngineeringDashboardData;

final readonly class FeatureEngineeringDashboardService
{
    public function __construct(
        private FeatureEngineeringQueryService $queryService,
        private FeatureEngineeringStatisticService $statisticService,
        private FeatureEngineeringTableService $tableService,
    ) {
    }

    /**
     * Build the Feature Engineering dashboard.
     */
    public function getDashboard(
        int $perPage = 20,
    ): FeatureEngineeringDashboardData {

        return new FeatureEngineeringDashboardData(

            statistics: $this->statisticService->getStatistics(),

            latestFeature: $this->queryService->latest(),

            table: $this->tableService->getTable(
                perPage: $perPage,
            ),

        );
    }
}