<?php

namespace App\Services;

class HistoricalAnalyticsService
{
    public function __construct(

        private readonly AnalyticsSummaryService $summaryService,

        private readonly AnalyticsTrendService $trendService,

        private readonly AnalyticsComparisonService $comparisonService,

    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    /**
     * Complete dashboard.
     */
    public function getDashboard(): array
    {
        return [

            'summary'

                =>

                $this->summaryService
                    ->getOverview(),

            'trend'

                =>

                $this->trendService
                    ->getTrendOverview(),

            'comparison'

                =>

                $this->comparisonService
                    ->getComparisonOverview(),

            'generated_at'

                =>

                now(),

        ];
    }

    /**
     * Summary.
     */
    public function getSummary(): array
    {
        return

            $this->summaryService
                ->getOverview();

    }

    /**
     * Trends.
     */
    public function getTrend(): array
    {
        return

            $this->trendService
                ->getTrendOverview();

    }

    /**
     * Comparison.
     */
    public function getComparison(): array
    {
        return

            $this->comparisonService
                ->getComparisonOverview();

    }
}