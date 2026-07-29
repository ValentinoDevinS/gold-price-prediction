<?php

declare(strict_types=1);

namespace App\Services\FullArticle;

use App\DTOs\FullArticle\FullArticleData;
use App\Repositories\FullArticleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class FullArticleQueryService
{
    public function __construct(
        private FullArticleRepository $repository,
    ) {
    }

    /**
     * Paginated full articles.
     */
    public function paginate(
        array $filters = [],
        ?string $search = null,
        ?string $sort = null,
        ?string $direction = null,
        int $perPage = 20,
    ): LengthAwarePaginator {

        $result = $this->repository->getPaginated(
            filters: $filters,
            search: $search,
            sort: $sort,
            direction: $direction,
            perPage: $perPage,
        );

        $result->setCollection(
            collect(
                FullArticleData::collection(
                    $result->items(),
                ),
            ),
        );

        return $result;

    }

    /**
     * Find a full article by UUID.
     */
    public function findByUuid(
        string $uuid,
    ): ?FullArticleData {

        $fullArticle = $this->repository
            ->findByUuid($uuid);

        if ($fullArticle === null) {
            return null;
        }

        return FullArticleData::fromModel(
            $fullArticle,
        );

    }

    /**
     * Latest downloaded article.
     */
    public function latest(): ?FullArticleData
    {
        $fullArticle = $this->repository
            ->latest();

        if ($fullArticle === null) {
            return null;
        }

        return FullArticleData::fromModel(
            $fullArticle,
        );
    }

    /**
     * Full articles waiting for cleaning.
     *
     * @return array<int, FullArticleData>
     */
    public function pendingCleaning(): array
    {
        return FullArticleData::collection(
            $this->repository->findPendingCleaning(),
        );
    }
}