<?php

declare(strict_types=1);

namespace App\Services\Training;

use App\DTOs\Training\TrainingDashboardData;
use App\Http\Requests\Training\TrainingIndexRequest;

final readonly class TrainingDashboardService
{
    public function __construct(
        private TrainingQueryService $queryService,
        private TrainingStatisticService $statisticService,
        private TrainingTableService $tableService,
    ) {
    }

    /**
     * Build training dashboard.
     */
    public function build(
        TrainingIndexRequest $request,
    ): TrainingDashboardData {

        $rows = $this->queryService->paginate($request);

        return TrainingDashboardData::make(

            statistics: $this->statisticService->statistics(),

            latestModel: $this->queryService->latest(),

            table: $this->tableService->build($rows),

        );
    }
}