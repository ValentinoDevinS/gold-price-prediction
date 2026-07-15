<?php

namespace App\Services;

use App\Models\SentimentAnalysis;
use App\Repositories\CleanArticleRepository;
use App\Repositories\SentimentAnalysisRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SentimentAnalysisService extends BaseService
{
    public function __construct(
        private readonly SentimentAnalysisRepository $repository,
        private readonly CleanArticleRepository $cleanArticleRepository,
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | CRUD
    |--------------------------------------------------------------------------
    */

    /**
     * Create a new sentiment analysis.
     */
    public function create(array $data): SentimentAnalysis
    {
        return $this->execute(function () use ($data) {

            $data['clean_article_id'] =

                $this->cleanArticleRepository
                    ->getIdByUuid(
                        $data['clean_article_uuid']
                    );

            unset(
                $data['clean_article_uuid']
            );

            return $this->repository
                ->create($data);

        });
    }

    /**
     * Update sentiment analysis.
     */
    public function update(
        string $uuid,
        array $data
    ): bool {

        return $this->execute(function () use ($uuid, $data) {

            $sentiment = $this->repository
                ->findOrFailByUuid($uuid);

            return $this->repository
                ->update(
                    $sentiment,
                    $data
                );

        });

    }

    /**
     * Delete sentiment analysis.
     */
    public function delete(
        string $uuid
    ): bool {

        return $this->execute(function () use ($uuid) {

            $sentiment = $this->repository
                ->findOrFailByUuid($uuid);

            return $this->repository
                ->delete($sentiment);

        });

    }

    /**
     * Find by UUID.
     */
    public function findByUuid(
        string $uuid
    ): SentimentAnalysis {

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