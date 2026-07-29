<?php

declare(strict_types=1);

namespace App\Services\FeatureEngineering;

use App\DTOs\FeatureEngineering\FeatureEngineeringData;
use App\Repositories\FeatureSnapshotRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final readonly class FeatureEngineeringQueryService
{
    public function __construct(
        private FeatureSnapshotRepository $repository,
    ) {
    }

    /**
     * Paginated feature snapshots.
     */
    public function paginate(
        array $filters = [],
        ?string $search = null,
        ?string $sort = null,
        ?string $direction = null,
        int $perPage = 20,
    ): LengthAwarePaginator {

        $features = $this->repository->getPaginated(
            filters: $filters,
            search: $search,
            sort: $sort,
            direction: $direction,
            perPage: $perPage,
        );

        $features->setCollection(

            $features->getCollection()->map(

                static fn ($feature) => FeatureEngineeringData::fromModel(
                    $feature,
                ),

            ),

        );

        return $features;
    }

    /**
     * Find feature by UUID.
     */
    public function findByUuid(
        string $uuid,
    ): ?FeatureEngineeringData {

        $feature = $this->repository->findByUuid($uuid);

        if ($feature === null) {
            return null;
        }

        return FeatureEngineeringData::fromModel(
            $feature,
        );
    }

    /**
     * Latest generated feature.
     */
    public function latest(): ?FeatureEngineeringData
    {
        $feature = $this->repository->latestFeature();

        if ($feature === null) {
            return null;
        }

        return FeatureEngineeringData::fromModel(
            $feature,
        );
    }

    /**
     * Latest generated features.
     *
     * @return Collection<int, FeatureEngineeringData>
     */
    public function latestMany(
        int $limit = 5,
    ): Collection {

        return $this->repository
            ->latestFeatures($limit)
            ->map(

                static fn ($feature) => FeatureEngineeringData::fromModel(
                    $feature,
                ),

            );
    }

    /**
     * Features waiting for prediction.
     *
     * @return Collection<int, FeatureEngineeringData>
     */
    public function pendingPrediction(): Collection
    {
        return $this->repository
            ->findPendingPrediction()
            ->map(

                static fn ($feature) => FeatureEngineeringData::fromModel(
                    $feature,
                ),

            );
    }
}