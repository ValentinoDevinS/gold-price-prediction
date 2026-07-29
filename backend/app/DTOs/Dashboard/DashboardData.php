<?php

declare(strict_types=1);

namespace App\DTOs\Dashboard;

final readonly class DashboardData
{
    public function __construct(
        public float $currentGoldPrice,
        public float $priceChange,

        public float $predictionPrice,
        public string $predictionTrend,

        public float $accuracy,

        public string $sentiment,

        public int $newsCount,

        public string $pipelineStatus,
    ) {}
}