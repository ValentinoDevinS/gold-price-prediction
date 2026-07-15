<?php

namespace App\Services;

use App\Models\ModelStatistic;
use App\Models\PredictionResult;
use App\Services\ModelStatisticHistoryService;
use App\Repositories\ModelStatisticRepository;
use App\Repositories\PredictionEvaluationRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ModelStatisticService extends BaseService
{
    public function __construct(
        private readonly ModelStatisticRepository $repository,
        private readonly PredictionEvaluationRepository $evaluationRepository,
        private readonly ModelStatisticHistoryService $historyService,
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | Public API
    |--------------------------------------------------------------------------
    */

    public function recalculateModel(
        string $modelName
    ): ModelStatistic {

        return

            $this->execute(

                function ()

                use (

                    $modelName

                ) {

                    $evaluations =

                        $this->loadEvaluations(
                            $modelName
                        );

                    $statistics =

                        $this->calculateStatistics(
                            $evaluations
                        );

                    return

                        $this->storeStatistics(

                            modelName: $modelName,

                            statistics: $statistics

                        );

                }

            );

    }

    public function recalculateAllModels(): void
    {
        $this->execute(function () {

            foreach (

                PredictionResult::availableModels()

                as

                $model

            ) {

                $this->recalculateModel(
                    $model
                );

            }

            $this->updateLeaderboard();

            $this->historyService
                ->createSnapshot();

        });
    }

    public function delete(
        string $uuid
    ): bool {

        return $this->execute(function () use ($uuid) {

            $statistic =

                $this->repository
                    ->findOrFailByUuid(
                        $uuid
                    );

            return

                $this->repository
                    ->delete(
                        $statistic
                    );

        });

    }

    public function findByUuid(
        string $uuid
    ): ModelStatistic {

        return

            $this->repository
                ->findOrFailByUuid(
                    $uuid
                );

    }

    public function getPaginated(
        array $filters = [],
        ?string $search = null,
        ?string $sort = null,
        ?string $direction = null,
        int $perPage = 20
    ): LengthAwarePaginator {

        return

            $this->repository
                ->getPaginated(

                    filters: $filters,

                    search: $search,

                    sort: $sort,

                    direction: $direction,

                    perPage: $perPage

                );

    }

    /*
    |--------------------------------------------------------------------------
    | Internal
    |--------------------------------------------------------------------------
    */

    private function loadEvaluations(
        string $modelName
    ): Collection
    {
        return

            $this->evaluationRepository
                ->getByModelName(
                    $modelName
                );
    }

    private function calculateStatistics(
        Collection $evaluations
    ): array {

        if (

            $evaluations->isEmpty()

        ) {

            return [

                'total_predictions' => 0,

                'best_prediction_count' => 0,

                'win_rate' => 0,

                'mae' => 0,

                'rmse' => 0,

                'mape' => 0,

                'average_absolute_error' => 0,

                'average_percentage_error' => 0,

                'latest_prediction_date' => null,

            ];

        }

        $totalPredictions =

            $evaluations->count();

        $mae =

            (float)

            $evaluations
                ->avg(
                    'absolute_error'
                );

        $mape =

            (float)

            $evaluations
                ->avg(
                    'percentage_error'
                );

        $rmse =

            sqrt(

                (float)

                $evaluations
                    ->avg(
                        'squared_error'
                    )

            );

        return [

            'total_predictions'

                =>

                $totalPredictions,

            'best_prediction_count'

                =>

                0,

            'win_rate'

                =>

                0,

            'mae'

                =>

                round(
                    $mae,
                    6
                ),

            'rmse'

                =>

                round(
                    $rmse,
                    6
                ),

            'mape'

                =>

                round(
                    $mape,
                    6
                ),

            'average_absolute_error'

                =>

                round(
                    $mae,
                    6
                ),

            'average_percentage_error'

                =>

                round(
                    $mape,
                    6
                ),

            'latest_prediction_date'

                =>

                $evaluations

                    ->max(
                        'actual_price_date'
                    ),

        ];

    }

    private function storeStatistics(
        string $modelName,
        array $statistics
    ): ModelStatistic {

        $existing =

            $this->repository
                ->findByModelName(
                    $modelName
                );

        $data = [

            'model_name'

                =>

                $modelName,

            ...$statistics,

            'calculated_at'

                =>

                now(),

        ];

        if (

            $existing

        ) {

            $this->repository
                ->update(

                    $existing,

                    $data

                );

            return

                $existing->fresh();

        }

        return

            $this->repository
                ->create(
                    $data
                );

    }

    private function updateLeaderboard(): void
    {
        $statistics =

            $this->repository
                ->getOrderedByMae()
                ->values();

        if (

            $statistics->isEmpty()

        ) {

            return;

        }

        $this->updateRanking(
            $statistics
        );

        $this->updatePredictionStatistics();

    }

    private function updateRanking(
        Collection $statistics
    ): void
    {
        $bestMae =

            (float)

            $statistics
                ->first()
                ->mae;

        $rank = 1;

        foreach (

            $statistics

            as

            $statistic

        ) {

            $this->repository
                ->update(

                    $statistic,

                    [

                        'ranking_position'

                            =>

                            $rank,

                        'difference_from_best'

                            =>

                            round(

                                (float) $statistic->mae
                                -
                                $bestMae,

                                6

                            ),

                    ]

                );

            $rank++;

        }

    }

    private function updatePredictionStatistics(): void
    {
        $statistics =

            $this->countModelWins();

        $this->updateWinRates(
            $statistics
        );
    }

    /**
     * Count model performance statistics.
     */
    private function countModelWins(): array
    {
        $groups =

            $this->evaluationRepository
                ->getGroupedByActualPriceDate()
                ->values();

        $statistics = [];

        foreach (

            PredictionResult::availableModels()

            as

            $model

        ) {

            $statistics[$model] = [

                'wins' => 0,

            ];

        }

        foreach (

            $groups

            as

            $evaluations

        ) {

            $winner =

                $evaluations

                    ->sortBy(
                        'absolute_error'
                    )

                    ->first();

            if (

                ! $winner ||
                ! $winner->predictionResult

            ) {

                continue;

            }

            $modelName =

                $winner
                    ->predictionResult
                    ->model_name;

            if (

                isset(
                    $statistics[$modelName]
                )

            ) {

                $statistics[$modelName]['wins']++;

            }

        }

        return $statistics;
    }

    private function updateWinRates(
        array $statistics
    ): void
    {
        foreach (

            $statistics

            as

            $model

            =>

            $data

        ) {

            $statistic =

                $this->repository
                    ->findByModelName(
                        $model
                    );

            if (

                ! $statistic

            ) {

                continue;

            }

            $wins =

                $data['wins'];

            $total =

                (int)

                $statistic
                    ->total_predictions;

            $winRate =

                $total > 0

                    ?

                    round(

                        (

                            $wins
                            /

                            $total

                        ) * 100,

                        4

                    )

                    :

                    0;

            $this->repository
                ->update(

                    $statistic,

                    [

                        'best_prediction_count'

                            =>

                            $wins,

                        'win_rate'

                            =>

                            $winRate,

                    ]

                );

        }

    }

    /**
     * Get leaderboard ordered by ranking.
     */
    public function leaderboard(): Collection
    {
        return

            $this->repository

                ->getPaginated(

                    filters: [],

                    search: null,

                    sort: 'ranking_position',

                    direction: 'asc',

                    perPage: 100

                )

                ->getCollection();

    }

    /**
     * Dashboard summary.
     */
    public function dashboard(): array
    {
        $leaderboard =

            $this->leaderboard();

        return [

            'generated_at'

                =>

                now(),

            'latest_prediction_date'

                =>

                optional(

                    $leaderboard

                        ->first()

                )->latest_prediction_date,

            'total_models'

                =>

                $leaderboard
                    ->count(),

            'best_model'

                =>

                $leaderboard
                    ->first(),

            'leaderboard'

                =>

                $leaderboard,

        ];
    }
    
}