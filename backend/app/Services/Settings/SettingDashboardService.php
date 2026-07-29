<?php

declare(strict_types=1);

namespace App\Services\Settings;

use App\DTOs\Settings\SettingDashboardDto;

final class SettingDashboardService
{
    public function __construct(
        private readonly SettingStatisticService $statisticService,
        private readonly SettingQueryService $queryService,
        private readonly SettingTableService $tableService,
    ) {
    }

    /**
     * Build settings dashboard.
     */
    public function build(): SettingDashboardDto
    {
        $rows = $this->queryService->paginate();

        return SettingDashboardDto::make(
            statistics: $this->statisticService->getStatistics(),
            table: $this->tableService->build($rows),
        );
    }
}