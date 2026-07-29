<?php

declare(strict_types=1);

namespace App\Services\FullArticle;

use App\Repositories\FullArticleRepository;

final readonly class FullArticleStatisticService
{
    public function __construct(
        private FullArticleRepository $repository,
    ) {
    }

    /**
     * Build dashboard statistics.
     *
     * @return array{
     *     downloaded:int,
     *     pending:int,
     *     failed:int,
     *     total_words:int,
     * }
     */
    public function build(): array
    {
        return [

            'downloaded' => $this->repository->countDownloaded(),

            'pending' => $this->repository->countPending(),

            'failed' => $this->repository->countFailed(),

            'total_words' => $this->repository->totalWords(),

        ];
    }
}