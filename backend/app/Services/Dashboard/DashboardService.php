<?php

declare(strict_types=1);

namespace App\Services\Dashboard;

use App\DTOs\Dashboard\DashboardData;

final class DashboardService
{
    public function getDashboardData(): DashboardData
    {
        return new DashboardData(
            currentGoldPrice: $this->currentGoldPrice(),
            priceChange: $this->priceChange(),

            predictionPrice: $this->predictionPrice(),
            predictionTrend: $this->predictionTrend(),

            accuracy: $this->accuracy(),

            sentiment: $this->sentiment(),

            newsCount: $this->newsCount(),

            pipelineStatus: $this->pipelineStatus(),
        );
    }

    private function currentGoldPrice(): float
    {
        return 3412.50;
    }

    private function priceChange(): float
    {
        return 0.72;
    }

    private function predictionPrice(): float
    {
        return 3425.80;
    }

    private function predictionTrend(): string
    {
        return 'Bullish';
    }

    private function accuracy(): float
    {
        return 94.30;
    }

    private function sentiment(): string
    {
        return 'Positive';
    }

    private function newsCount(): int
    {
        return 18;
    }

    private function pipelineStatus(): string
    {
        return 'Completed';
    }
}