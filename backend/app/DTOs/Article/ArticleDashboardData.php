<?php

declare(strict_types=1);

namespace App\DTOs\Article;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class ArticleDashboardData
{
    /**
     * @param array<string, int> $statistics
     */
    public function __construct(
        public array $statistics,

        public ?ArticleData $latestArticle,

        public LengthAwarePaginator $articles,
    ) {
    }
}