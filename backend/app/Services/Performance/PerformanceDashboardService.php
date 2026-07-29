<?php

declare(strict_types=1);

namespace App\Services\Performance;

use App\DTOs\Performance\PerformanceDashboardData;

final readonly class PerformanceDashboardService
{
    public function __construct(
        private PerformanceQueryService $queryService,
        private PerformanceStatisticService $statisticService,
        private PerformanceTableService $tableService,
    ) {
    }

    /**
     * Build the Performance dashboard.
     */
    public function getDashboard(
        array $filters = [],
        ?string $search = null,
        ?string $sort = null,
        ?string $direction = null,
        int $perPage = 20,
    ): PerformanceDashboardData {

        return new PerformanceDashboardData(

            statistics: $this->statisticService
                ->getStatistics(),

            latestPerformance: $this->queryService
                ->latest(),

            table: $this->tableService
                ->getTable(
                    filters: $filters,
                    search: $search,
                    sort: $sort,
                    direction: $direction,
                    perPage: $perPage,
                ),

        );
    }
}