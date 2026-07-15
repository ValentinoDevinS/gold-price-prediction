<?php

namespace App\Services;

use App\Models\FullArticle;
use App\Repositories\FullArticleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FullArticleService extends BaseService
{
    public function __construct(
        private readonly FullArticleRepository $repository
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | CRUD
    |--------------------------------------------------------------------------
    */

    /**
     * Create a new full article.
     */
    public function create(
        array $data
    ): FullArticle {

        return $this->execute(function () use ($data) {

            return $this->repository->create($data);

        });

    }

    /**
     * Update a full article.
     */
    public function update(
        string $uuid,
        array $data
    ): bool {

        return $this->execute(function () use ($uuid, $data) {

            $fullArticle = $this->repository
                ->findOrFailByUuid($uuid);

            return $this->repository
                ->update(
                    $fullArticle,
                    $data
                );

        });

    }

    /**
     * Delete a full article.
     */
    public function delete(
        string $uuid
    ): bool {

        return $this->execute(function () use ($uuid) {

            $fullArticle = $this->repository
                ->findOrFailByUuid($uuid);

            return $this->repository
                ->delete($fullArticle);

        });

    }

    /**
     * Find full article by UUID.
     */
    public function findByUuid(
        string $uuid
    ): FullArticle {

        return $this->repository
            ->findOrFailByUuid($uuid);

    }

    /**
     * Paginated list.
     */
    public function getPaginated(
        array $filters = [],
        ?string $search = null,
        ?string $sort = null,
        ?string $direction = null,
        int $perPage = 20
    ): LengthAwarePaginator {

        return $this->repository
            ->getPaginated(
                filters: $filters,
                search: $search,
                sort: $sort,
                direction: $direction,
                perPage: $perPage
            );

    }
}