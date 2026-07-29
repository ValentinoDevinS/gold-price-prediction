<?php

declare(strict_types=1);

namespace App\Services\SentimentAnalysis;

use App\DTOs\SentimentAnalysis\SentimentAnalysisData;
use App\Repositories\SentimentAnalysisRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

final readonly class SentimentAnalysisQueryService
{
    public function __construct(
        private SentimentAnalysisRepository $repository,
    ) {
    }

    /**
     * Paginated sentiment analyses.
     */
    public function paginate(
        int $perPage = 20,
    ): LengthAwarePaginator {

        $paginator = $this->repository->paginate($perPage);

        $paginator->setCollection(

            $paginator
                ->getCollection()
                ->map(
                    fn ($sentiment) => SentimentAnalysisData::fromModel($sentiment)
                )

        );

        return $paginator;
    }

    /**
     * Find sentiment by UUID.
     */
    public function findByUuid(
        string $uuid,
    ): ?SentimentAnalysisData {

        $sentiment = $this->repository
            ->findByUuid($uuid);

        if (! $sentiment) {
            return null;
        }

        return SentimentAnalysisData::fromModel(
            $sentiment,
        );
    }

    /**
     * Latest sentiment analysis.
     */
    public function latest(): ?SentimentAnalysisData
    {
        $sentiment = $this->repository
            ->latestSentiment();

        if (! $sentiment) {
            return null;
        }

        return SentimentAnalysisData::fromModel(
            $sentiment,
        );
    }

    /**
     * Latest sentiment analyses.
     *
     * @return Collection<int, SentimentAnalysisData>
     */
    public function latestMany(
        int $limit = 5,
    ): Collection {

        return $this->repository

            ->latestSentiments($limit)

            ->map(
                fn ($sentiment) => SentimentAnalysisData::fromModel($sentiment)
            );
    }

    /**
     * Sentiments waiting for Feature Engineering.
     *
     * @return Collection<int, SentimentAnalysisData>
     */
    public function pendingFeatureGeneration(): Collection
    {
        return $this->repository

            ->findPendingFeatureGeneration()

            ->map(
                fn ($sentiment) => SentimentAnalysisData::fromModel($sentiment)
            );
    }
}