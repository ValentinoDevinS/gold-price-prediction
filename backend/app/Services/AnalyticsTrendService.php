<?php

namespace App\Services;

use App\Repositories\HistoricalAnalyticsRepository;
use Illuminate\Support\Collection;

class AnalyticsTrendService
{
    public function __construct(
        private readonly HistoricalAnalyticsRepository $repository,
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | Public API
    |--------------------------------------------------------------------------
    */

    /**
     * Dashboard trend overview.
     */
    public function getTrendOverview(): array
    {
        return [

            'mae'

                =>

                $this->getMaeTrend(),

            'rmse'

                =>

                $this->getRmseTrend(),

            'mape'

                =>

                $this->getMapeTrend(),

            'win_rate'

                =>

                $this->getWinRateTrend(),

            'ranking'

                =>

                $this->getRankingTrend(),

            'generated_at'

                =>

                now(),

        ];
    }

    /**
     * MAE Trend.
     */
    public function getMaeTrend(): array
    {
        return $this->buildTrendResponse(

            title:'MAE Trend',

            badge:'📈',

            metric:'mae',

            chartType:'line',

            supportedCharts:[
                'line',
                'bar',
                'area',
            ],

            data:$this->repository
                ->getMaeTrendByModel(),

            dateColumn:'actual_price_date',

            help:$this->helpMae(),

        );
    }

    /**
     * RMSE Trend.
     */
    public function getRmseTrend(): array
    {
        return $this->buildTrendResponse(

            title:'MAE Trend',

            badge:'📈',

            metric:'mae',

            chartType:'line',

            supportedCharts:[
                'line',
                'bar',
                'area',
            ],

            data:$this->repository
                ->getMaeTrendByModel(),

            dateColumn:'actual_price_date',

            help:$this->helpMae(),

        );
    }

    /**
     * MAPE Trend.
     */
    public function getMapeTrend(): array
    {
        return $this->buildTrendResponse(

            title:'MAE Trend',

            badge:'📈',

            metric:'mae',

            chartType:'line',

            supportedCharts:[
                'line',
                'bar',
                'area',
            ],

            data:$this->repository
                ->getMaeTrendByModel(),

            dateColumn:'actual_price_date',

            help:$this->helpMae(),

        );
    }

    /**
     * Win Rate Trend.
     */
    public function getWinRateTrend(): array
    {
        return $this->buildTrendResponse(

            title:'MAE Trend',

            badge:'📈',

            metric:'mae',

            chartType:'line',

            supportedCharts:[
                'line',
                'bar',
                'area',
            ],

            data:$this->repository
                ->getMaeTrendByModel(),

            dateColumn:'actual_price_date',

            help:$this->helpMae(),

        );
    }

    /**
     * Ranking Trend.
     */
    public function getRankingTrend(): array
    {
        return $this->buildTrendResponse(

            title:'MAE Trend',

            badge:'📈',

            metric:'mae',

            chartType:'line',

            supportedCharts:[
                'line',
                'bar',
                'area',
            ],

            data:$this->repository
                ->getMaeTrendByModel(),

            dateColumn:'actual_price_date',

            help:$this->helpMae(),

        );
    }

    /*
    |--------------------------------------------------------------------------
    | Builders
    |--------------------------------------------------------------------------
    */

        /**
     * Build a standardized trend response.
     */
    private function buildTrendResponse(
        string $title,
        string $badge,
        string $metric,
        string $chartType,
        array $supportedCharts,
        Collection $data,
        string $dateColumn,
        array $help
    ): array {

        return [

            'title'

                =>

                $title,

            'badge'

                =>

                $badge,

            'status'

                =>

                'normal',

            'metric'

                =>

                $metric,

            'chart_type'

                =>

                $chartType,

            'supported_charts'

                =>

                $supportedCharts,

            'labels'

                =>

                $this->buildLabels(

                    data: $data,

                    dateColumn: $dateColumn,

                ),

            'datasets'

                =>

                $this->buildDatasets(

                    data: $data,

                    metric: $metric,

                ),

            'description'

                =>

                "Historical {$title} over time.",

            'help'

                =>

                $help,

            'updated_at'

                =>

                now(),

        ];

    }

    /**
     * Build chart labels.
     */
    private function buildLabels(
        Collection $data,
        string $dateColumn
    ): array {

        return

            $data

                ->pluck(
                    $dateColumn
                )

                ->unique()

                ->values()

                ->toArray();

    }

    /**
     * Build datasets grouped by model.
     */
    private function buildDatasets(
        Collection $data,
        string $metric
    ): array {

        return

            $data

                ->groupBy(
                    'model_name'
                )

                ->map(

                    function (

                        Collection $rows,

                        string $model

                    ) use (

                        $metric

                    ) {

                        return [

                            'label'

                                =>

                                $model,

                            'data'

                                =>

                                $rows

                                    ->sortBy(

                                        fn ($row)

                                            =>

                                            $row->actual_price_date

                                            ??

                                            $row->snapshot_date

                                    )

                                    ->pluck(
                                        $metric
                                    )

                                    ->values()

                                    ->toArray(),

                        ];

                    }

                )

                ->values()

                ->toArray();

    }

    /*
    |--------------------------------------------------------------------------
    | Help
    |--------------------------------------------------------------------------
    */

    private function helpMae(): array
    {
        return [

            'definition'

                =>

                'Mean Absolute Error measures the average prediction error.',

            'formula'

                =>

                'AVG(absolute_error)',

            'interpretation'

                =>

                'Lower values indicate better prediction accuracy.',

            'importance'

                =>

                'Primary metric used for ranking prediction models.',

        ];
    }

    private function helpRmse(): array
    {
        return [

            'definition'

                =>

                'Root Mean Square Error penalizes larger prediction errors.',

            'formula'

                =>

                'SQRT(AVG(squared_error))',

            'interpretation'

                =>

                'Lower values indicate more consistent predictions.',

            'importance'

                =>

                'Useful for identifying models with occasional large errors.',

        ];
    }

    private function helpMape(): array
    {
        return [

            'definition'

                =>

                'Mean Absolute Percentage Error measures prediction error in percentage.',

            'formula'

                =>

                'AVG(percentage_error)',

            'interpretation'

                =>

                'Lower percentages indicate better prediction performance.',

            'importance'

                =>

                'Allows performance comparison across different price ranges.',

        ];
    }

    private function helpWinRate(): array
    {
        return [

            'definition'

                =>

                'Win Rate represents how often a model achieved the best prediction.',

            'formula'

                =>

                'Best predictions / Total predictions',

            'interpretation'

                =>

                'Higher values indicate more frequent top performance.',

            'importance'

                =>

                'Shows long-term competitiveness between models.',

        ];
    }

    private function helpRanking(): array
    {
        return [

            'definition'

                =>

                'Historical ranking position of each prediction model.',

            'formula'

                =>

                'Ranking generated from ModelStatisticService.',

            'interpretation'

                =>

                'Rank #1 represents the best performing model.',

            'importance'

                =>

                'Shows how model performance changes over time.',

        ];
    }

}