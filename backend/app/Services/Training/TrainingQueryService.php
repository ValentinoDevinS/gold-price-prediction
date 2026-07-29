<?php

declare(strict_types=1);

namespace App\Services\Training;

use App\DTOs\Training\TrainingData;
use App\Http\Requests\Training\TrainingIndexRequest;
use App\Repositories\MlModelRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class TrainingQueryService
{
    public function __construct(
        private readonly MlModelRepository $repository,
    ) {
    }

    /**
     * Paginated model list.
     */
    public function paginate(
        TrainingIndexRequest $request,
    ): LengthAwarePaginator {

        $validated = $request->validated();

        $paginator = $this->repository->getPaginated(

            filters: [

                'model_type' => $validated['model_type'] ?? null,

                'status' => $validated['status'] ?? null,

            ],

            search: $validated['search'] ?? null,

            sort: $validated['sort'] ?? null,

            direction: $validated['direction'] ?? null,

            perPage: (int) ($validated['per_page'] ?? 20),

        );

        $paginator->setCollection(

            $paginator
                ->getCollection()
                ->map(
                    fn (mixed $model) => TrainingData::fromModel($model)
                )

        );

        return $paginator;
    }

    /**
     * Find model by UUID.
     */
    public function findByUuid(
        string $uuid,
    ): ?TrainingData {

        $model = $this->repository->findByUuid($uuid);

        return $model
            ? TrainingData::fromModel($model)
            : null;
    }

    /**
     * Latest trained model.
     */
    public function latest(): ?TrainingData
    {
        $model = $this->repository->latestModel();

        return $model
            ? TrainingData::fromModel($model)
            : null;
    }

    /**
     * Active models.
     *
     * @return array<int, TrainingData>
     */
    public function activeModels(): array
    {
        return $this->repository
            ->activeModels()
            ->map(
                fn ($model) => TrainingData::fromModel($model)
            )
            ->all();
    }

    /**
     * Latest model by type.
     */
    public function latestByType(
        \App\Enums\ModelType $type,
    ): ?TrainingData {

        $model = $this->repository->latestByType($type);

        return $model
            ? TrainingData::fromModel($model)
            : null;
    }
}