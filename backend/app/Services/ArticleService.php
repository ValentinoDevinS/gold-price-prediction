<?php

namespace App\Services;

use App\Helpers\HashHelper;
use App\Repositories\ArticleRepository;

class ArticleService extends BaseService
{
    public function __construct(
        private readonly ArticleRepository $repository
    ) {
    }

    /**
     * Register new article.
     */
    public function create(array $data)
    {
        return $this->execute(function () use ($data) {

            $data['url_hash'] = HashHelper::generate(
                $data['url']
            );

            if (
                $this->repository->findByHash(
                    $data['url_hash']
                )
            ) {
                return null;
            }

            return $this->repository->create($data);

        });
    }

    /**
     * List latest articles.
     */
    public function list(int $perPage = 20)
    {
        return $this->repository
            ->latestArticles($perPage);
    }

    /**
     * Search.
     */
    public function search(
        ?string $keyword,
        array $filters = [],
        int $perPage = 20
    ) {
        return $this->repository
            ->searchArticles(
                $keyword,
                $filters,
                $perPage
            );
    }
}