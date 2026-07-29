<?php

declare(strict_types=1);

namespace App\Services\Article;

use App\Http\Requests\Article\ArticleIndexRequest;

final readonly class ArticleDashboardService
{
    public function __construct(
        private ArticleStatisticService $statisticService,
        private ArticleTableService $tableService,
        private ArticleQueryService $queryService,
    ) {
    }

    /**
     * Build dashboard payload.
     *
     * @return array{
     *     statistics: array<string,int>,
     *     latestArticle: \App\DTOs\Article\ArticleData|null,
     *     table: \App\Data\Ui\TableData,
     * }
     */
    public function dashboard(
        ArticleIndexRequest $request,
    ): array {

        return [

            'statistics' => $this->statisticService
                ->statistics(),

            'latestArticle' => $this->queryService
                ->latest(),

            'table' => $this->tableService
                ->build($request),

        ];
    }
}