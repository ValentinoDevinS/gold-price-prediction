<?php

declare(strict_types=1);

namespace App\Services\Dashboard;

final class DashboardService
{
    /**
     * Dashboard statistic cards.
     *
     * @return array<string, array<string, string|int|null>>
     */
    public function statistics(): array
    {
        return [
            'articles' => [
                'title' => 'Articles Collected',
                'value' => 0,
                'description' => 'News articles available',
            ],

            'goldPrice' => [
                'title' => 'Latest Gold Price',
                'value' => 'N/A',
                'description' => 'Waiting for market data',
            ],

            'prediction' => [
                'title' => 'Prediction Accuracy',
                'value' => 'N/A',
                'description' => 'No prediction available',
            ],

            'system' => [
                'title' => 'System Health',
                'value' => 'Healthy',
                'description' => 'All services operational',
            ],
        ];
    }

    /**
     * Gold price chart.
     *
     * @return array<int, mixed>
     */
    public function chart(): array
    {
        return [];
    }

    /**
     * Prediction summary.
     *
     * @return array<int, mixed>
     */
    public function predictionSummary(): array
    {
        return [];
    }

    /**
     * Quick actions.
     *
     * @return array<int, mixed>
     */
    public function quickActions(): array
    {
        return [];
    }

    /**
     * Recent activities.
     *
     * @return array<int, mixed>
     */
    public function recentActivities(): array
    {
        return [];
    }

    /**
     * Latest collected articles.
     *
     * @return array<int, array<string, mixed>>
     */
    public function latestArticles(): array
    {
        return [];
    }
}