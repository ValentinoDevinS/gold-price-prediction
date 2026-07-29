<?php

declare(strict_types=1);

namespace App\Services\Training;

use App\Repositories\MlModelRepository;

final class TrainingStatisticService
{
    public function __construct(
        private readonly MlModelRepository $repository,
    ) {
    }

    /**
     * Dashboard statistics.
     */
    public function statistics(): array
    {
        return [

            'total' => $this->repository->countModels(),

            'active' => $this->repository->countActiveModels(),

            'average_training_time' => $this->repository->averageTrainingTime(),

            'largest_dataset' => $this->repository->largestDataset(),

        ];
    }
}