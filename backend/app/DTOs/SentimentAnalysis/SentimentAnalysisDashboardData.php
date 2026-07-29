<?php

declare(strict_types=1);

namespace App\DTOs\SentimentAnalysis;

use App\Data\Ui\TableData;

final readonly class SentimentAnalysisDashboardData
{
    public function __construct(
        public array $statistics,
        public ?SentimentAnalysisData $latestSentiment,
        public TableData $table,
    ) {
    }

    /**
     * Create dashboard DTO.
     */
    public static function make(
        array $statistics,
        ?SentimentAnalysisData $latestSentiment,
        TableData $table,
    ): self {

        return new self(
            statistics: $statistics,
            latestSentiment: $latestSentiment,
            table: $table,
        );
    }
}