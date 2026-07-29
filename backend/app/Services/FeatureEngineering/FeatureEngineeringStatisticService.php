<?php

declare(strict_types=1);

namespace App\Services\FeatureEngineering;

use App\Repositories\FeatureSnapshotRepository;

final readonly class FeatureEngineeringStatisticService
{
    public function __construct(
        private FeatureSnapshotRepository $repository,
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

            'average_sentiment' => $this->repository->averageSentiment(),

            'average_word_count' => $this->repository->averageWordCount(),

            'average_article_count' => $this->repository->averageArticleCount(),

            'pending_prediction' => $this->repository->countPendingPrediction(),

            'processed_prediction' => $this->repository->countProcessedPrediction(),

        ];
    }
}