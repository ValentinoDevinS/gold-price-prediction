<?php

namespace App\Services;

use App\Models\FeatureSnapshot;
use App\Repositories\FeatureSnapshotRepository;
use App\Repositories\SentimentAnalysisRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FeatureSnapshotService extends BaseService
{
    public function __construct(
        private readonly FeatureSnapshotRepository $repository,
        private readonly SentimentAnalysisRepository $sentimentRepository,
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | CRUD
    |--------------------------------------------------------------------------
    */

    /**
     * Create a new Feature Snapshot.
     */
    public function create(array $data): FeatureSnapshot
    {
        return $this->execute(function () use ($data) {

            $data['sentiment_analysis_id'] =

            $this->sentimentRepository
                ->getIdByUuid(
                    $data['sentiment_analysis_uuid']
                );

            unset(
                $data['sentiment_analysis_uuid']
            );

            return $this->repository
                ->create($data);

        });
    }

    /**
     * Update Feature Snapshot.
     */
    public function update(
        string $uuid,
        array $data
    ): bool {

        return $this->execute(function () use ($uuid, $data) {

            $feature =

            $this->repository
                ->findOrFailByUuid(
                    $uuid
                );

            return $this->repository
                ->update(
                    $feature,
                    $data
                );

        });

    }

    /**
     * Delete Feature Snapshot.
     */
    public function delete(
        string $uuid
    ): bool {

        return $this->execute(function () use ($uuid) {

            $feature =

            $this->repository
                ->findOrFailByUuid(
                    $uuid
                );

            return $this->repository
                ->delete(
                    $feature
                );

        });

    }

    /**
     * Find by UUID.
     */
    public function findByUuid(
        string $uuid
    ): FeatureSnapshot {

        return $this->repository
            ->findOrFailByUuid(
                $uuid
            );

    }

    /**
     * Paginated list.
     */
    public function getPaginated(
        array $filters = [],
        ?string $search = null,
        ?string $sort = null,
        ?string $direction = null,
        int $perPage = 20
    ): LengthAwarePaginator {

        return $this->repository
            ->getPaginated(
                filters: $filters,
                search: $search,
                sort: $sort,
                direction: $direction,
                perPage: $perPage
            );
    }
}