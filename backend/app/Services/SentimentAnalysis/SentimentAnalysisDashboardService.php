<?php

declare(strict_types=1);

namespace App\Services\SentimentAnalysis;

final readonly class SentimentAnalysisDashboardService
{
    public function __construct(
        private SentimentAnalysisQueryService $queryService,
        private SentimentAnalysisStatisticService $statisticService,
        private SentimentAnalysisTableService $tableService,
    ) {
    }

    /**
     * Dashboard data.
     */
    public function getDashboard(
        int $perPage = 20,
    ): array {

        $rows = $this->queryService
            ->paginate($perPage);

        return [

            'statistics' =>

                $this->statisticService
                    ->getStatistics(),

            'latestSentiment' =>

                $this->queryService
                    ->latest(),

            'table' =>

                $this->tableService
                    ->build($rows),

        ];
    }
}