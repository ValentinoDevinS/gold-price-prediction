<?php

namespace App\Repositories;

use App\Models\ModelStatisticHistory;
use Illuminate\Database\Eloquent\Collection;

class ModelStatisticHistoryRepository extends BaseRepository
{
    protected function model(): string
    {
        return ModelStatisticHistory::class;
    }

    protected array $searchable = [

        'model_name',

        'evaluation_scope',

    ];

    protected array $filterable = [

        'model_name',

        'snapshot_sequence',

        'snapshot_date',

        'evaluation_scope',

    ];

    protected array $sortable = [

        'snapshot_sequence',

        'ranking_position',

        'snapshot_date',

        'mae',

        'rmse',

        'win_rate',

    ];

    /**
     * Next snapshot sequence.
     */
    public function nextSnapshotSequence(): int
    {
        return

            (int)

            $this->model
                ->max(
                    'snapshot_sequence'
                ) + 1;
    }

    /**
     * Latest snapshot.
     */
    public function latestSnapshot(): Collection
    {
        $snapshotUuid =

            $this->model

                ->latest(
                    'snapshot_sequence'
                )

                ->value(
                    'snapshot_uuid'
                );

        if (! $snapshotUuid) {

            return collect();

        }

        return

            $this->getSnapshot(
                $snapshotUuid
            );

    }

    /**
     * Snapshot by UUID.
     */
    public function getSnapshot(
        string $snapshotUuid
    ): Collection
    {
        return

            $this->model

                ->where(
                    'snapshot_uuid',
                    $snapshotUuid
                )

                ->orderBy(
                    'ranking_position'
                )

                ->get();

    }

    /**
     * Previous ranking of a model.
     */
    public function getPreviousRanking(
        string $snapshotUuid,
        string $modelName
    ): ?int
    {
        return

            $this->model

                ->where(
                    'snapshot_uuid',
                    $snapshotUuid
                )

                ->where(
                    'model_name',
                    $modelName
                )

                ->value(
                    'ranking_position'
                );

    }

    /**
     * History of one model.
     */
    public function getModelHistory(
        string $modelName
    ): Collection
    {
        return

            $this->model

                ->where(
                    'model_name',
                    $modelName
                )

                ->orderByDesc(
                    'snapshot_sequence'
                )

                ->get();

    }

    /**
     * Bulk insert snapshot.
     */
    public function insertSnapshot(
        array $rows
    ): bool
    {
        return

            $this->model

                ->insert(
                    $rows
                );

    }
}