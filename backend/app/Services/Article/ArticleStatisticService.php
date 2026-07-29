<?php

declare(strict_types=1);

namespace App\Services\Article;

use App\Enums\ArticleStatus;
use App\Repositories\ArticleRepository;

final class ArticleStatisticService
{
    public function __construct(
        private readonly ArticleRepository $repository,
    ) {
    }

    /**
     * Dashboard statistics.
     *
     * @return array<string,int>
     */
    public function statistics(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Collection
            |--------------------------------------------------------------------------
            */

            'total_articles' => $this->repository->count(),

            'today_articles' => $this->repository->countToday(),

            'total_sources' => $this->repository->countSources(),

            /*
            |--------------------------------------------------------------------------
            | Pipeline Status
            |--------------------------------------------------------------------------
            */

            'pending_articles' => $this->repository->countByStatus(
                ArticleStatus::PENDING,
            ),

            'downloaded_articles' => $this->repository->countByStatus(
                ArticleStatus::DOWNLOADED,
            ),

            'processed_articles' => $this->repository->countByStatus(
                ArticleStatus::PROCESSED,
            ),

            'failed_articles' => $this->repository->countByStatus(
                ArticleStatus::FAILED,
            ),

        ];
    }
}