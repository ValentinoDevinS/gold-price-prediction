<?php

declare(strict_types=1);

namespace App\Services\Prediction;

use App\Repositories\PredictionResultRepository;

final readonly class PredictionStatisticService
{
    public function __construct(
        private PredictionResultRepository $repository,
    ) {
    }

    /**
     * Get dashboard statistics.
     */
    public function getStatistics(): array
    {
        return [

            'total' => $this->repository->countAll(),

            'today' => $this->repository->countToday(),

            'average_confidence' => round(
                $this->repository->averageConfidence(),
                4,
            ),

            'average_predicted_price' => round(
                $this->repository->averagePredictedPrice(),
                2,
            ),

            'evaluated' => $this->repository->countEvaluated(),

            'pending_evaluation' => $this->repository->countPendingEvaluation(),

        ];
    }
}