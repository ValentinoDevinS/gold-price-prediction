<?php

declare(strict_types=1);

namespace App\Services\CleanArticle;

use App\DTOs\CleanArticle\CleanArticleData;
use App\Http\Requests\CleanArticle\CleanArticleIndexRequest;
use App\Repositories\CleanArticleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class CleanArticleQueryService
{
    public function __construct(
        private readonly CleanArticleRepository $repository,
    ) {
    }

    /**
     * Paginated clean article list.
     */
    public function paginate(
        CleanArticleIndexRequest $request,
    ): LengthAwarePaginator {

        $validated = $request->validated();

        $paginator = $this->repository->getPaginated(
            filters: [
                'cleaner_version' => $validated['cleaner_version'] ?? null,
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
                    fn ($cleanArticle) => CleanArticleData::fromModel($cleanArticle)
                )

        );

        return $paginator;
    }

    /**
     * Find by UUID.
     */
    public function findByUuid(
        string $uuid,
    ): ?CleanArticleData {

        $cleanArticle = $this->repository->findByUuid($uuid);

        return $cleanArticle
            ? CleanArticleData::fromModel($cleanArticle)
            : null;
    }

    /**
     * Latest clean article.
     */
    public function latest(): ?CleanArticleData
    {
        $cleanArticle = $this->repository->latestCleanArticle();

        return $cleanArticle
            ? CleanArticleData::fromModel($cleanArticle)
            : null;
    }

    /**
     * Clean articles waiting for sentiment analysis.
     *
     * @return array<int, CleanArticleData>
     */
    public function pendingSentiment(): array
    {
        return $this->repository
            ->findPendingSentiment()
            ->map(
                fn ($cleanArticle) => CleanArticleData::fromModel($cleanArticle)
            )
            ->all();
    }
}