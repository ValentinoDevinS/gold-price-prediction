<?php

namespace App\Services;

use App\Models\CleanArticle;
use App\Repositories\CleanArticleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CleanArticleService extends BaseService
{
    public function __construct(

        private readonly CleanArticleRepository $repository,

        private readonly FullArticleRepository $fullArticleRepository,

    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | CRUD
    |--------------------------------------------------------------------------
    */

    public function create(
        array $data
    ): CleanArticle
    {
        return $this->execute(function () use ($data) {

            $data['full_article_id'] =

                $this->fullArticleRepository

                    ->getIdByUuid(

                        $data['full_article_uuid']

                    );

            unset(

                $data['full_article_uuid']

            );

            return $this->repository

                ->create($data);

        });
    }

    public function delete(
        string $uuid
    ): bool {

        return $this->execute(function () use ($uuid) {

            $cleanArticle = $this->repository
                ->findOrFailByUuid($uuid);

            return $this->repository
                ->delete($cleanArticle);

        });

    }

    public function findByUuid(
        string $uuid
    ): CleanArticle {

        return $this->repository
            ->findOrFailByUuid($uuid);

    }

    public function getPaginated(
        array $filters = [],
        ?string $search = null,
        ?string $sort = null,
        ?string $direction = null,
        int $perPage = 20
    ): LengthAwarePaginator {

        return $this->repository->getPaginated(
            filters: $filters,
            search: $search,
            sort: $sort,
            direction: $direction,
            perPage: $perPage
        );

    }
}