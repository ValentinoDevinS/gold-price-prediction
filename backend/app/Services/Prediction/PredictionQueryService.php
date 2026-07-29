<?php

declare(strict_types=1);

namespace App\Services\Prediction;

use App\DTOs\Prediction\PredictionData;
use App\DTOs\Prediction\PredictionTableRowData;
use App\Repositories\PredictionResultRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final readonly class PredictionQueryService
{
    public function __construct(
        private PredictionResultRepository $repository,
        private PredictionSetBuilder $builder,
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | Prediction Sets
    |--------------------------------------------------------------------------
    */

    /**
     * Paginate prediction sets.
     */
    public function paginate(
        array $filters = [],
        ?string $search = null,
        ?string $sort = null,
        ?string $direction = null,
        int $perPage = 20,
    ): LengthAwarePaginator {

        $paginator = $this->repository->getPaginated(
            filters: $filters,
            search: $search,
            sort: $sort,
            direction: $direction,
            perPage: $perPage,
        );

        $predictionSets = $paginator
            ->getCollection()
            ->groupBy('feature_snapshot_id')
            ->map(
                fn (Collection $predictions): PredictionTableRowData
                    => $this->builder->build($predictions)
            )
            ->values();

        $paginator->setCollection(
            collect($predictionSets)
        );

        return $paginator;
    }

    /**
     * Latest prediction set.
     */
    public function latestPredictionSet(): ?PredictionTableRowData
    {
        $predictions = $this->repository
            ->latestPredictionSet();

        if ($predictions->isEmpty()) {
            return null;
        }

        return $this->builder->build(
            $predictions,
        );
    }

    /**
     * Prediction set by Feature Snapshot.
     */
    public function predictionSetByFeatureSnapshot(
        int $featureSnapshotId,
    ): ?PredictionTableRowData {

        $predictions = $this->repository
            ->predictionSetByFeatureSnapshot(
                $featureSnapshotId,
            );

        if ($predictions->isEmpty()) {
            return null;
        }

        return $this->builder->build(
            $predictions,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Single Prediction
    |--------------------------------------------------------------------------
    */

    public function findByUuid(
        string $uuid,
    ): ?PredictionData {

        $prediction = $this->repository
            ->findByUuid($uuid);

        if ($prediction === null) {
            return null;
        }

        return PredictionData::fromModel(
            $prediction,
        );
    }

    public function latest(): ?PredictionData
    {
        $prediction = $this->repository
            ->latestPrediction();

        if ($prediction === null) {
            return null;
        }

        return PredictionData::fromModel(
            $prediction,
        );
    }

    public function latestMany(
        int $limit = 5,
    ): Collection {

        return $this->repository
            ->latestPredictions($limit)
            ->map(
                fn ($prediction) => PredictionData::fromModel(
                    $prediction
                )
            );
    }

    public function pendingEvaluation(): Collection
    {
        return $this->repository
            ->findPendingEvaluation()
            ->map(
                fn ($prediction) => PredictionData::fromModel(
                    $prediction
                )
            );
    }

    public function byModel(
        string $modelName,
    ): Collection {

        return $this->repository
            ->getByModel($modelName)
            ->map(
                fn ($prediction) => PredictionData::fromModel(
                    $prediction
                )
            );
    }
}