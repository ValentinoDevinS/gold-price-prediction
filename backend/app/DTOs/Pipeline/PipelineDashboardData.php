<?php

declare(strict_types=1);

namespace App\DTOs\Pipeline;

use App\Support\Table\TableData;

final readonly class PipelineDashboardData
{
    /**
     * @param array<string, mixed> $statistics
     */
    private function __construct(
        public array $statistics,
        public TableData $table,
    ) {
    }

    /**
     * Create a new PipelineDashboardData instance.
     *
     * @param array<string, mixed> $statistics
     */
    public static function make(
        array $statistics,
        TableData $table,
    ): self {

        return new self(
            statistics: $statistics,
            table: $table,
        );

    }

    /**
     * Get a statistic value.
     */
    public function statistic(
        string $key,
        mixed $default = null,
    ): mixed {
        return $this->statistics[$key] ?? $default;
    }
}