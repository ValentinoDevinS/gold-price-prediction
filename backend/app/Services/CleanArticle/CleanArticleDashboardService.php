<?php

declare(strict_types=1);

namespace App\Services\CleanArticle;

use App\Http\Requests\CleanArticle\CleanArticleIndexRequest;

final class CleanArticleDashboardService
{
    public function __construct(
        private readonly CleanArticleQueryService $queryService,
        private readonly CleanArticleStatisticService $statisticService,
        private readonly CleanArticleTableService $tableService,
    ) {
    }

    /**
     * Build dashboard data.
     */
    public function dashboard(
        CleanArticleIndexRequest $request,
    ): array {

        $rows = $this->queryService->paginate(
            $request
        );

        return [

            'statistics' => $this->statisticService->statistics(),

            'latestCleanArticle' => $this->queryService->latest(),

            'table' => $this->tableService->build(
                $rows
            ),

        ];
    }
}