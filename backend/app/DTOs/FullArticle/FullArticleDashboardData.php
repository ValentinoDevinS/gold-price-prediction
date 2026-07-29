<?php

declare(strict_types=1);

namespace App\DTOs\FullArticle;

use App\Data\Ui\TableData;

final readonly class FullArticleDashboardData
{
    /**
     * @param array<string, mixed> $statistics
     */
    public function __construct(
        public array $statistics,
        public ?FullArticleData $latestArticle,
        public TableData $table,
    ) {
    }
}