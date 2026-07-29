<?php

declare(strict_types=1);

namespace App\Services\Performance;

use App\DTOs\Performance\PerformanceData;
use App\Repositories\PredictionEvaluationRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final readonly class PerformanceQueryService
{
    public function __construct(
        private PredictionEvaluationRepository $repository,
    ) {
    }

    /**
     * Paginated performance records.
     */
    public function paginate(
        array $filters = [],
        ?string $search = null,
        ?string $sort = null,
        ?string $direction = null,
        int $perPage = 20,
    ): LengthAwarePaginator {

        $results = $this->repository->getPaginated(
            filters: $filters,
            search: $search,
            sort: $sort,
            direction: $direction,
            perPage: $perPage,
        );

        $results->setCollection(

            $results->getCollection()

                ->map(
                    fn ($evaluation) => PerformanceData::fromModel(
                        $evaluation
                    )
                )

        );

        return $results;
    }

    /**
     * Find one performance record.
     */
    public function findByUuid(
        string $uuid,
    ): ?PerformanceData {

        $evaluation = $this->repository
            ->findByUuid($uuid);

        if ($evaluation === null) {
            return null;
        }

        return PerformanceData::fromModel(
            $evaluation
        );
    }

    /**
     * Latest evaluated prediction.
     */
    public function latest(): ?PerformanceData
    {
        $evaluation = $this->repository
            ->latestEvaluation();

        if ($evaluation === null) {
            return null;
        }

        return PerformanceData::fromModel(
            $evaluation
        );
    }

    /**
     * Latest evaluations.
     */
    public function latestMany(
        int $limit = 10,
    ): Collection {

        return $this->repository

            ->latestEvaluations($limit)

            ->map(
                fn ($evaluation) => PerformanceData::fromModel(
                    $evaluation
                )
            );
    }

    /**
     * Performance by model.
     */
    public function byModel(
        string $model,
    ): Collection {

        return $this->repository

            ->byModel($model)

            ->map(
                fn ($evaluation) => PerformanceData::fromModel(
                    $evaluation
                )
            );
    }
}