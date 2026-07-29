<?php

declare(strict_types=1);

namespace App\DTOs\CleanArticle;

use App\Data\Ui\TableData;

final readonly class CleanArticleDashboardData
{
    public function __construct(
        public array $statistics,

        public ?CleanArticleData $latestCleanArticle,

        public TableData $table,
    ) {
    }

    /**
     * Create dashboard DTO.
     */
    public static function make(
        array $statistics,
        ?CleanArticleData $latestCleanArticle,
        TableData $table,
    ): self {

        return new self(
            statistics: $statistics,
            latestCleanArticle: $latestCleanArticle,
            table: $table,
        );
    }
}