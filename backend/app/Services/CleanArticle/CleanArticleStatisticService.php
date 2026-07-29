<?php

declare(strict_types=1);

namespace App\Services\CleanArticle;

use App\Repositories\CleanArticleRepository;

final class CleanArticleStatisticService
{
    public function __construct(
        private readonly CleanArticleRepository $repository,
    ) {
    }

    /**
     * Dashboard statistics.
     */
    public function statistics(): array
    {
        return [

            'total' => $this->repository->count(),

            'today' => $this->repository->countToday(),

            'average_original_words' => $this->repository->averageOriginalWordCount(),

            'average_clean_words' => $this->repository->averageCleanWordCount(),

            'pending_sentiment' => $this->repository->countPendingSentiment(),

            'processed_sentiment' => $this->repository->countProcessedSentiment(),

        ];
    }
}