<?php

declare(strict_types=1);

namespace App\Services\Pipeline;

use App\DTOs\Pipeline\PipelineDashboardData;

final readonly class PipelineDashboardService
{
    public function __construct(
        private PipelineStatisticService $statisticService,
        private PipelineTableService $tableService,
    ) {
    }

    /**
     * Build the pipeline dashboard.
     */
    public function getDashboard(): PipelineDashboardData
    {
        return PipelineDashboardData::make(
            statistics: $this->statisticService->getStatistics(),
            table: $this->tableService->getTable(),
        );
    }
}