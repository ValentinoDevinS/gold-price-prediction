<?php

namespace App\Services;

use App\Models\ModelStatistic;
use App\Models\ModelStatisticHistory;
use App\Repositories\ModelStatisticHistoryRepository;
use App\Repositories\ModelStatisticRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ModelStatisticHistoryService extends BaseService
{
    public function __construct(
        private readonly ModelStatisticHistoryRepository $repository,
        private readonly ModelStatisticRepository $modelStatisticRepository,
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | CRUD
    |--------------------------------------------------------------------------
    */

    /**
     * Get paginated history.
     */
    public function getPaginated(
        array $filters = [],
        ?string $search = null,
        ?string $sort = null,
        ?string $direction = null,
        int $perPage = 20
    ): LengthAwarePaginator {

        return $this->repository->getPaginated(
            filters: $filters,
            search: $search,
            sort: $sort,
            direction: $direction,
            perPage: $perPage,
        );

    }

    /**
     * Find history by UUID.
     */
    public function findByUuid(
        string $uuid
    ): ModelStatisticHistory {

        return $this->repository
            ->findOrFailByUuid(
                $uuid
            );

    }

    /**
     * Delete history.
     */
    public function delete(
        string $uuid
    ): bool {

        return $this->execute(

            function () use ($uuid) {

                $history =

                    $this->repository
                        ->findOrFailByUuid(
                            $uuid
                        );

                return

                    $this->repository
                        ->delete(
                            $history
                        );

            }

        );

    }

    /*
    |--------------------------------------------------------------------------
    | Snapshot
    |--------------------------------------------------------------------------
    */

    /**
     * Create leaderboard snapshot.
     */
    public function createSnapshot(): void
    {
        $this->execute(

            function () {

                $statistics =

                    $this->loadCurrentStatistics();

                if (

                    $statistics->isEmpty()

                ) {

                    return;

                }

                $snapshot =

                    $this->buildSnapshotMetadata();

                $previousSnapshot =

                    $this->repository
                        ->latestSnapshot();

                $rows =

                    $this->buildSnapshotRows(

                        statistics: $statistics,

                        snapshot: $snapshot,

                        previousSnapshot: $previousSnapshot,

                    );

                $this->repository
                    ->insertSnapshot(
                        $rows
                    );

            }

        );
    }

    /*
    |--------------------------------------------------------------------------
    | Internal
    |--------------------------------------------------------------------------
    */

    /**
     * Load current leaderboard.
     */
    private function loadCurrentStatistics(): Collection
    {
        return

            $this->modelStatisticRepository
                ->getLeaderboard();
    }

    /**
     * Generate snapshot metadata.
     */
    private function buildSnapshotMetadata(): array
    {
        return [

            'snapshot_uuid'

                =>

                (string) Str::uuid(),

            'snapshot_sequence'

                =>

                $this->repository
                    ->nextSnapshotSequence(),

            'snapshot_date'

                =>

                now()->toDateString(),

            'evaluation_scope'

                =>

                'ALL_TIME',

            'evaluation_period_start'

                =>

                optional(

                    $this->modelStatisticRepository
                        ->getLeaderboard()
                        ->first()

                )->latest_prediction_date,

            'evaluation_period_end'

                =>

                now()->toDateString(),

        ];
    }

        /**
     * Build snapshot rows.
     */
    private function buildSnapshotRows(
        Collection $statistics,
        array $snapshot,
        Collection $previousSnapshot
    ): array {

        $rows = [];

        foreach (

            $statistics as $statistic

        ) {

            $rows[] =

                $this->buildHistoryRow(

                    statistic: $statistic,

                    snapshot: $snapshot,

                    previousSnapshot: $previousSnapshot,

                );

        }

        return $rows;

    }

    /**
     * Build one history row.
     */
    private function buildHistoryRow(
        ModelStatistic $statistic,
        array $snapshot,
        Collection $previousSnapshot
    ): array {

        $previousRanking =

            $this->findPreviousRanking(

                modelName: $statistic->model_name,

                previousSnapshot: $previousSnapshot,

            );

        $rankingChange =

            $this->calculateRankingChange(

                previousRanking: $previousRanking,

                currentRanking: $statistic->ranking_position,

            );

        return [

            'uuid'

                =>

                (string) Str::uuid(),

            'snapshot_uuid'

                =>

                $snapshot['snapshot_uuid'],

            'snapshot_sequence'

                =>

                $snapshot['snapshot_sequence'],

            'snapshot_date'

                =>

                $snapshot['snapshot_date'],

            'evaluation_scope'

                =>

                $snapshot['evaluation_scope'],

            'evaluation_period_start'

                =>

                $snapshot['evaluation_period_start'],

            'evaluation_period_end'

                =>

                $snapshot['evaluation_period_end'],

            'model_name'

                =>

                $statistic->model_name,

            'ranking_position'

                =>

                $statistic->ranking_position,

            'previous_ranking'

                =>

                $previousRanking,

            'ranking_change'

                =>

                $rankingChange,

            'is_snapshot_winner'

                =>

                $statistic->ranking_position === 1,

            'total_predictions'

                =>

                $statistic->total_predictions,

            'best_prediction_count'

                =>

                $statistic->best_prediction_count,

            'win_rate'

                =>

                $statistic->win_rate,

            'mae'

                =>

                $statistic->mae,

            'rmse'

                =>

                $statistic->rmse,

            'mape'

                =>

                $statistic->mape,

            'average_absolute_error'

                =>

                $statistic->average_absolute_error,

            'average_percentage_error'

                =>

                $statistic->average_percentage_error,

            'difference_from_best'

                =>

                $statistic->difference_from_best,

            'calculated_at'

                =>

                $statistic->calculated_at,

            'created_at'

                =>

                now(),

            'updated_at'

                =>

                now(),

        ];

    }

    /**
     * Find previous ranking.
     */
    private function findPreviousRanking(
        string $modelName,
        Collection $previousSnapshot
    ): ?int {

        if (

            $previousSnapshot->isEmpty()

        ) {

            return null;

        }

        $previous =

            $previousSnapshot

                ->firstWhere(

                    'model_name',

                    $modelName

                );

        if (

            ! $previous

        ) {

            return null;

        }

        return

            $previous->ranking_position;

    }

        /**
     * Calculate ranking movement.
     *
     * Positive value  : Improved ranking
     * Zero            : No change
     * Negative value  : Dropped ranking
     */
    private function calculateRankingChange(
        ?int $previousRanking,
        int $currentRanking
    ): int {

        /*
        |--------------------------------------------------------------------------
        | First Snapshot
        |--------------------------------------------------------------------------
        */

        if (

            $previousRanking === null

        ) {

            return 0;

        }

        /*
        |--------------------------------------------------------------------------
        | Formula
        |--------------------------------------------------------------------------
        |
        | Previous = 4
        | Current  = 2
        |
        | Result = +2 (Improved)
        |
        | Previous = 1
        | Current  = 3
        |
        | Result = -2 (Dropped)
        |
        */

        return

            $previousRanking - $currentRanking;

    }

    /*
    |--------------------------------------------------------------------------
    | Analytics Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Determine whether a snapshot already exists.
     */
    public function hasSnapshots(): bool
    {
        return

            $this->repository
                ->nextSnapshotSequence() > 1;

    }

    /**
     * Latest snapshot.
     */
    public function latestSnapshot(): Collection
    {
        return

            $this->repository
                ->latestSnapshot();

    }

    /**
     * Get one snapshot.
     */
    public function getSnapshot(
        string $snapshotUuid
    ): Collection {

        return

            $this->repository
                ->getSnapshot(
                    $snapshotUuid
                );

    }

    /**
     * History of one model.
     */
    public function getModelHistory(
        string $modelName
    ): Collection {

        return

            $this->repository
                ->getModelHistory(
                    $modelName
                );

    }

}