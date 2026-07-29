<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\ModelStatus;
use App\Enums\ModelType;
use App\Models\MlModel;
use Illuminate\Database\Eloquent\Collection;

final class MlModelRepository extends BaseRepository
{
    protected array $searchable = [
        'model_name',
        'model_version',
        'description',
    ];

    protected array $sortable = [
        'trained_until',
        'dataset_size',
        'training_time',
        'created_at',
    ];

    protected array $with = [];

    protected string $defaultSort = 'trained_until';

    protected string $defaultDirection = 'desc';

    public function __construct(
        MlModel $model,
    ) {
        parent::__construct($model);
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public function latestModel(): ?MlModel
    {
        return $this->query()
            ->latest('trained_until')
            ->first();
    }

    public function latestModels(
        int $limit = 10,
    ): Collection {

        return $this->query()
            ->latest('trained_until')
            ->limit($limit)
            ->get();
    }

    public function latestByType(
        ModelType $type,
    ): ?MlModel {

        return $this->query()
            ->where('model_type', $type)
            ->latest('trained_until')
            ->first();
    }

    /*
    |--------------------------------------------------------------------------
    | Statistics
    |--------------------------------------------------------------------------
    */

    public function countModels(): int
    {
        return $this->query()->count();
    }

    public function countActiveModels(): int
    {
        return $this->query()
            ->where('status', ModelStatus::ACTIVE)
            ->count();
    }

    public function averageTrainingTime(): float
    {
        return round(
            $this->query()->avg('training_time') ?? 0,
            2
        );
    }

    public function largestDataset(): int
    {
        return (int) (
            $this->query()->max('dataset_size') ?? 0
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Business Rules
    |--------------------------------------------------------------------------
    */

    public function activeModels(): Collection
    {
        return $this->query()
            ->where('status', ModelStatus::ACTIVE)
            ->orderBy('model_type')
            ->get();
    }
}