<?php

namespace App\Services;

use App\Models\PredictionResult;
use App\Repositories\FeatureSnapshotRepository;
use App\Repositories\PredictionResultRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PredictionResultService extends BaseService
{
    public function __construct(
        private readonly PredictionResultRepository $repository,
        private readonly FeatureSnapshotRepository $featureSnapshotRepository,
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | CRUD
    |--------------------------------------------------------------------------
    */

    public function create(
        array $data
    ): PredictionResult {

        return $this->execute(function () use ($data) {

            $data['feature_snapshot_id'] =

            $this->featureSnapshotRepository
                ->getIdByUuid(
                    $data['feature_snapshot_uuid']
                );

            unset(
                $data['feature_snapshot_uuid']
            );

            return $this->repository
                ->create(
                    $data
                );

        });

    }

    public function update(
        string $uuid,
        array $data
    ): bool {

        return $this->execute(function () use ($uuid, $data) {

            $prediction =

            $this->repository
                ->findOrFailByUuid(
                    $uuid
                );

            return $this->repository
                ->update(
                    $prediction,
                    $data
                );

        });

    }

    public function delete(
        string $uuid
    ): bool {

        return $this->execute(function () use ($uuid) {

            $prediction =

            $this->repository
                ->findOrFailByUuid(
                    $uuid
                );

            return $this->repository
                ->delete(
                    $prediction
                );

        });

    }

    public function findByUuid(
        string $uuid
    ): PredictionResult {

        return $this->repository
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