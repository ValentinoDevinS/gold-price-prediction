<?php

declare(strict_types=1);

namespace App\DTOs\Performance;

use App\Support\Table\Table;

final readonly class PerformanceDashboardData
{
    public function __construct(

        public array $statistics,

        public ?PerformanceData $latestPerformance,

        public Table $table,

    ) {
    }
}