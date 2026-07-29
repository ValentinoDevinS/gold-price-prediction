<?php

declare(strict_types=1);

namespace App\Services\SentimentAnalysis;

use App\Repositories\SentimentAnalysisRepository;

final readonly class SentimentAnalysisStatisticService
{
    public function __construct(
        private SentimentAnalysisRepository $repository,
    ) {
    }

    /**
     * Dashboard statistics.
     */
    public function getStatistics(): array
    {
        return [

            'total' => $this->repository->count(),

            'today' => $this->repository->countToday(),

            'positive' => $this->repository->countPositive(),

            'neutral' => $this->repository->countNeutral(),

            'negative' => $this->repository->countNegative(),

            'pending_feature_generation' =>

                $this->repository
                    ->countPendingFeatureGeneration(),

            'processed_feature_generation' =>

                $this->repository
                    ->countProcessedFeatureGeneration(),

        ];
    }
}