<?php

namespace App\Services;

use App\Repositories\HistoricalAnalyticsRepository;

class AnalyticsComparisonService
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
     * Complete comparison overview.
     */
    public function getComparisonOverview(): array
    {
        return [

            'comparison'

                =>

                $this->compareModels(),

            'dominance'

                =>

                $this->getDominanceAnalysis(),

            'stability'

                =>

                $this->getStabilityAnalysis(),

            'improvement'

                =>

                $this->getImprovementAnalysis(),

            'historical_champion'

                =>

                $this->getHistoricalChampion(),

            'generated_at'

                =>

                now(),

        ];
    }

    /**
     * Current comparison.
     */
    public function compareModels(): array
    {
        $models =

            $this->repository
                ->getCurrentStatistics();

        return [

            'title'

                =>

                'Model Comparison',

            'badge'

                =>

                '⚖️',

            'status'

                =>

                'normal',

            'models'

                =>

                $models,

            'help'

                =>

                $this->helpComparison(),

            'generated_at'

                =>

                now(),

        ];

    }

    /**
     * Historical Champion.
     */
    public function getHistoricalChampion(): array
    {
        $history =

            $this->repository
                ->getRankingHistory();

        $champion =

            $history

                ->groupBy(
                    'model_name'
                )

                ->map(

                    fn ($rows)

                        =>

                        $rows

                            ->where(
                                'ranking_position',
                                1
                            )

                            ->count()

                )

                ->sortDesc();

        return [

            'title'

                =>

                'Historical Champion',

            'badge'

                =>

                '👑',

            'status'

                =>

                'excellent',

            'champion'

                =>

                $champion

                    ->keys()

                    ->first(),

            'wins'

                =>

                $champion

                    ->first(),

            'help'

                =>

                $this->helpHistoricalChampion(),

            'generated_at'

                =>

                now(),

        ];

    }

    /*
    |--------------------------------------------------------------------------
    | Analysis
    |--------------------------------------------------------------------------
    */

        /**
     * Dominance analysis.
     *
     * Counts how many snapshots each model occupied Rank #1.
     */
    public function getDominanceAnalysis(): array
    {
        $history = $this->repository->getRankingHistory();

        $dominance = $history

            ->where('ranking_position', 1)

            ->groupBy('model_name')

            ->map(fn ($rows) => $rows->count())

            ->sortDesc()

            ->map(function ($wins, $model) {

                return [

                    'model_name' => $model,

                    'wins' => $wins,

                ];

            })

            ->values();

        return [

            'title' => 'Model Dominance',

            'badge' => '🏆',

            'status' => 'normal',

            'leaders' => $dominance,

            'help' => $this->helpDominance(),

            'generated_at' => now(),

        ];
    }

    /**
     * Stability analysis.
     *
     * Lower average rank = more stable.
     */
    public function getStabilityAnalysis(): array
    {
        $history = $this->repository->getRankingHistory();

        $stability =

            $history

                ->groupBy('model_name')

                ->map(function ($rows, $model) {

                    return [

                        'model_name'

                            =>

                            $model,

                        'average_rank'

                            =>

                            round(

                                $rows

                                    ->avg('ranking_position'),

                                2

                            ),

                        'best_rank'

                            =>

                            $rows

                                ->min(

                                    'ranking_position'

                                ),

                        'worst_rank'

                            =>

                            $rows

                                ->max(

                                    'ranking_position'

                                ),

                    ];

                })

                ->sortBy(

                    'average_rank'

                )

                ->values();

        return [

            'title'

                =>

                'Model Stability',

            'badge'

                =>

                '📊',

            'status'

                =>

                'normal',

            'models'

                =>

                $stability,

            'help'

                =>

                $this->helpStability(),

            'generated_at'

                =>

                now(),

        ];

    }

    /**
     * Improvement analysis.
     */
    public function getImprovementAnalysis(): array
    {
        $models =

            $this->repository
                ->getAvailableModels();

        $result =

            collect();

        foreach ($models as $model) {

            $history =

                $this->repository

                    ->getModelHistory(

                        $model->model_name

                    );

            if (

                $history->count()

                < 2

            ) {

                continue;

            }

            $first =

                $history->first();

            $last =

                $history->last();

            $result->push([

                'model_name'

                    =>

                    $model->model_name,

                'first_rank'

                    =>

                    $first->ranking_position,

                'latest_rank'

                    =>

                    $last->ranking_position,

                'movement'

                    =>

                    $first->ranking_position

                    -

                    $last->ranking_position,

            ]);

        }

        return [

            'title'

                =>

                'Ranking Improvement',

            'badge'

                =>

                '📈',

            'status'

                =>

                'normal',

            'models'

                =>

                $result

                    ->sortByDesc(

                        'movement'

                    )

                    ->values(),

            'help'

                =>

                $this->helpImprovement(),

            'generated_at'

                =>

                now(),

        ];

    }

    /*
    |--------------------------------------------------------------------------
    | Help
    |--------------------------------------------------------------------------
    */

    private function helpComparison(): array
    {
        return [

            'definition'

                =>

                'Current performance comparison between all prediction models.',

            'formula'

                =>

                'Latest ModelStatistic records.',

            'interpretation'

                =>

                'Allows side-by-side model comparison.',

            'importance'

                =>

                'Primary comparison page.',

        ];
    }

    private function helpHistoricalChampion(): array
    {
        return [

            'definition'

                =>

                'Model with the highest number of Rank #1 finishes.',

            'formula'

                =>

                'COUNT(rank = 1)',

            'interpretation'

                =>

                'Measures long-term historical success.',

            'importance'

                =>

                'Shows overall historical winner.',

        ];
    }

    private function helpDominance(): array
    {
        return [

            'definition'

                =>

                'Number of snapshots a model stayed at Rank #1.',

            'formula'

                =>

                'COUNT(rank = 1)',

            'interpretation'

                =>

                'Higher values indicate stronger historical dominance.',

            'importance'

                =>

                'Useful for long-term comparison.',

        ];
    }

    private function helpStability(): array
    {
        return [

            'definition'

                =>

                'Average ranking position across all snapshots.',

            'formula'

                =>

                'AVG(ranking_position)',

            'interpretation'

                =>

                'Lower average rank means higher stability.',

            'importance'

                =>

                'Measures consistency over time.',

        ];
    }

    private function helpImprovement(): array
    {
        return [

            'definition'

                =>

                'Ranking movement between the first and latest snapshot.',

            'formula'

                =>

                'First Rank - Latest Rank',

            'interpretation'

                =>

                'Positive values indicate improvement.',

            'importance'

                =>

                'Shows long-term ranking progress.',

        ];
    }

}