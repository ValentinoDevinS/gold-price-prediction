<?php

declare(strict_types=1);

namespace App\Services\FullArticle;

use App\DTOs\FullArticle\FullArticleDashboardData;
use Illuminate\Http\Request;

final readonly class FullArticleDashboardService
{
    public function __construct(
        private FullArticleStatisticService $statisticService,
        private FullArticleQueryService $queryService,
        private FullArticleTableService $tableService,
    ) {
    }

    public function build(
        Request $request,
    ): FullArticleDashboardData {

        return new FullArticleDashboardData(
            statistics: $this->statisticService->build(),
            latestArticle: $this->queryService->latest(),
            table: $this->tableService->build($request),
        );

    }
}