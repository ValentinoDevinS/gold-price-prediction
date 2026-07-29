<?php

declare(strict_types=1);

namespace App\Services\Article;

use App\DTOs\Article\ArticleData;
use App\Http\Requests\Article\ArticleIndexRequest;
use App\Repositories\ArticleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class ArticleQueryService
{
    public function __construct(
        private readonly ArticleRepository $repository,
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | List
    |--------------------------------------------------------------------------
    */

    /**
     * Paginated article list.
     */
    public function paginate(
        ArticleIndexRequest $request,
    ): LengthAwarePaginator {

        $validated = $request->validated();

        $paginator = $this->repository->getPaginated(
            filters: [
                'status'   => $validated['status'] ?? null,
                'source'   => $validated['source'] ?? null,
                'language' => $validated['language'] ?? null,
                'country'  => $validated['country'] ?? null,
                'scraper'  => $validated['scraper'] ?? null,
            ],
            search: $validated['search'] ?? null,
            sort: $validated['sort'] ?? null,
            direction: $validated['direction'] ?? null,
            perPage: (int) ($validated['per_page'] ?? 20),
        );

        $paginator->setCollection(
            collect(
                ArticleData::collection(
                    $paginator->getCollection()
                )
            )
        );

        return $paginator;
    }

    /*
    |--------------------------------------------------------------------------
    | Detail
    |--------------------------------------------------------------------------
    */

    /**
     * Find article by UUID.
     */
    public function findByUuid(
        string $uuid,
    ): ?ArticleData {

        $article = $this->repository
            ->findByUuid($uuid);

        return $article
            ? ArticleData::fromModel($article)
            : null;
    }

    /**
     * Latest article.
     */
    public function latest(): ?ArticleData
    {
        $article = $this->repository
            ->latestArticle();

        return $article
            ? ArticleData::fromModel($article)
            : null;
    }

    /*
    |--------------------------------------------------------------------------
    | Pipeline
    |--------------------------------------------------------------------------
    */

    /**
     * Articles waiting to be downloaded.
     *
     * @return array<int, ArticleData>
     */
    public function pendingDownload(): array
    {
        return ArticleData::collection(
            $this->repository->pendingDownload()
        );
    }

    /**
     * Successfully downloaded articles.
     *
     * @return array<int, ArticleData>
     */
    public function downloaded(): array
    {
        return ArticleData::collection(
            $this->repository->downloaded()
        );
    }

    /**
     * Failed download articles.
     *
     * @return array<int, ArticleData>
     */
    public function failed(): array
    {
        return ArticleData::collection(
            $this->repository->failed()
        );
    }
}