<?php

declare(strict_types=1);

namespace App\DTOs\Training;

use App\Data\Ui\TableData;

final readonly class TrainingDashboardData
{
    public function __construct(
        public array $statistics,

        public ?TrainingData $latestModel,

        public TableData $table,
    ) {
    }

    /**
     * Create dashboard DTO.
     */
    public static function make(
        array $statistics,
        ?TrainingData $latestModel,
        TableData $table,
    ): self {

        return new self(
            statistics: $statistics,
            latestModel: $latestModel,
            table: $table,
        );
    }
}