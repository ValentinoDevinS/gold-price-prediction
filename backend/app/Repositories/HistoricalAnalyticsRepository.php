<?php

namespace App\Repositories;

use App\Models\ModelStatistic;
use App\Models\ModelStatisticHistory;
use App\Models\PredictionEvaluation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class HistoricalAnalyticsRepository
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard Summary
    |--------------------------------------------------------------------------
    */

    /**
     * Current leaderboard.
     */
    public function getLeaderboard(): Collection
    {
        return

            ModelStatistic::query()

                ->orderBy(
                    'ranking_position'
                )

                ->get();

    }

    /**
     * Current leader.
     */
    public function getCurrentLeader(): ?ModelStatistic
    {
        return

            ModelStatistic::query()

                ->where(
                    'ranking_position',
                    1
                )

                ->first();

    }

    /**
     * Total prediction evaluations.
     */
    public function getTotalPredictions(): int
    {
        return

            PredictionEvaluation::query()

                ->count();

    }

    /**
     * Total snapshots.
     */
    public function getTotalSnapshots(): int
    {
        return

            ModelStatisticHistory::query()

                ->distinct(
                    'snapshot_uuid'
                )

                ->count(
                    'snapshot_uuid'
                );

    }

    /**
     * Latest snapshot.
     */
    public function getLatestSnapshot(): Collection
    {
        $snapshotUuid =

            ModelStatisticHistory::query()

                ->latest(
                    'snapshot_sequence'
                )

                ->value(
                    'snapshot_uuid'
                );

        if (

            ! $snapshotUuid

        ) {

            return collect();

        }

        return

            ModelStatisticHistory::query()

                ->where(
                    'snapshot_uuid',
                    $snapshotUuid
                )

                ->orderBy(
                    'ranking_position'
                )

                ->get();

    }

        /*
    |--------------------------------------------------------------------------
    | Trend
    |--------------------------------------------------------------------------
    */

    /**
     * MAE trend grouped by model and date.
     */
    public function getMaeTrendByModel(): Collection
    {
        return $this->getMetricTrend(

            expression: 'AVG(prediction_evaluations.absolute_error)',

            alias: 'mae'

        );
    }

    /**
     * RMSE trend grouped by model and date.
     */
    public function getRmseTrendByModel(): Collection
    {
        return $this->getMetricTrend(

            expression: 'SQRT(AVG(prediction_evaluations.squared_error))',

            alias: 'rmse'

        );
    }

    /**
     * MAPE trend grouped by model and date.
     */
    public function getMapeTrendByModel(): Collection
    {
        return $this->getMetricTrend(

            expression: 'AVG(prediction_evaluations.percentage_error)',

            alias: 'mape'

        );
    }

    /**
     * Win rate trend.
     *
     * Reads historical snapshots.
     */
    public function getWinRateTrendByModel(): Collection
    {
        return ModelStatisticHistory::query()

            ->select(

                'model_name',

                'snapshot_sequence',

                'snapshot_date',

                'win_rate'

            )

            ->orderBy(

                'snapshot_sequence'

            )

            ->get();

    }

    /**
     * Ranking history.
     */
    public function getRankingHistory(): Collection
    {
        return ModelStatisticHistory::query()

            ->select(

                'model_name',

                'snapshot_sequence',

                'snapshot_date',

                'ranking_position'

            )

            ->orderBy(

                'snapshot_sequence'

            )

            ->orderBy(

                'ranking_position'

            )

            ->get();

    }

    /**
     * Shared trend query.
     */
    private function getMetricTrend(
        string $expression,
        string $alias
    ): Collection {

        return PredictionEvaluation::query()

            ->join(

                'prediction_results',

                'prediction_results.id',

                '=',

                'prediction_evaluations.prediction_result_id'

            )

            ->select(

                'prediction_results.model_name',

                'prediction_evaluations.actual_price_date',

                DB::raw(

                    $expression . ' AS ' . $alias

                )

            )

            ->groupBy(

                'prediction_results.model_name',

                'prediction_evaluations.actual_price_date'

            )

            ->orderBy(

                'prediction_evaluations.actual_price_date'

            )

            ->get();

    }

    /*
    |--------------------------------------------------------------------------
    | Comparison
    |--------------------------------------------------------------------------
    */

        /**
     * Complete history for one model.
     */
    public function getModelHistory(
        string $modelName
    ): Collection {

        return ModelStatisticHistory::query()

            ->where(

                'model_name',

                $modelName

            )

            ->orderBy(

                'snapshot_sequence'

            )

            ->get();

    }

    /**
     * Comparison dataset.
     *
     * Returns the latest statistics for all models.
     */
    public function getComparisonData(): Collection
    {
        return ModelStatistic::query()

            ->orderBy(

                'ranking_position'

            )

            ->get();

    }

    /**
     * Snapshot history.
     */
    public function getSnapshotHistory(): Collection
    {
        return ModelStatisticHistory::query()

            ->orderByDesc(

                'snapshot_sequence'

            )

            ->get();

    }

    /**
     * Available models.
     */
    public function getAvailableModels(): Collection
    {
        return ModelStatistic::query()

            ->select(

                'model_name'

            )

            ->orderBy(

                'ranking_position'

            )

            ->get();

    }

    /**
     * Latest statistics.
     */
    public function getCurrentStatistics(): Collection
    {
        return ModelStatistic::query()

            ->orderBy(

                'ranking_position'

            )

            ->get();

    }

}

    