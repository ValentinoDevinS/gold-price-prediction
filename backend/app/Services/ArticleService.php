<?php

namespace App\Services;

use App\Exceptions\Article\ArticleAlreadyExistsException;
use App\Helpers\HashHelper;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticleService extends BaseService
{
    public function __construct(
        private readonly ArticleRepository $repository
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | CRUD
    |--------------------------------------------------------------------------
    */

    /**
     * Create a new article.
     */
    public function create(array $data): Article
    {
        return $this->execute(function () use ($data) {

            $data['url_hash'] = $this->generateUrlHash(
                $data['url']
            );

            if (
                $this->repository->findByUrlHash(
                    $data['url_hash']
                )
            ) {
                throw new ArticleAlreadyExistsException();
            }

            return $this->repository->create($data);

        });
    }

    /**
     * Update an article.
     */
    public function update(
        string $uuid,
        array $data
    ): bool {

        return $this->execute(function () use ($uuid, $data) {

            $article = $this->repository
                ->findOrFailByUuid($uuid);

            if (
                array_key_exists(
                    'url',
                    $data
                )
            ) {

                $data['url_hash'] = $this->generateUrlHash(
                    $data['url']
                );

                $existingArticle = $this->repository
                    ->findByUrlHash(
                        $data['url_hash']
                    );

                if (
                    $existingArticle !== null &&
                    $existingArticle->uuid !== $article->uuid
                ) {

                    throw new ArticleAlreadyExistsException();

                }

            }

            return $this->repository
                ->update(
                    $article,
                    $data
                );

        });

    }

    /**
     * Delete an article.
     */
    public function delete(
        string $uuid
    ): bool {

        return $this->execute(function () use ($uuid) {

            $article = $this->repository
                ->findOrFailByUuid($uuid);

            return $this->repository
                ->delete($article);

        });

    }

    /**
     * Find article by UUID.
     */
    public function findByUuid(
        string $uuid
    ): Article {

        return $this->repository
            ->findOrFailByUuid($uuid);

    }

    /**
     * Retrieve paginated articles.
     */
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

    /**
     * Generate URL hash.
     */
    private function generateUrlHash(
        string $url
    ): string {

        return HashHelper::generate($url);

    }

    /*
    |--------------------------------------------------------------------------
    | Business
    |--------------------------------------------------------------------------
    */

    /**
     * Article statistics.
     *
     * @return array<string, array<string, string|int>>
     */
    public function statistics(): array
    {
        return [

            'total' => [

                'title' => 'Total Articles',

                'value' => $this->repository->count(),

                'description' => 'Collected articles',

            ],

            'new' => [

                'title' => 'New',

                'value' => $this->repository
                    ->countBy(
                        'status',
                        'NEW'
                    ),

                'description' => 'Waiting for download',

            ],

            'downloaded' => [

                'title' => 'Downloaded',

                'value' => $this->repository
                    ->countBy(
                        'status',
                        'DOWNLOADED'
                    ),

                'description' => 'Downloaded successfully',

            ],

            'failed' => [

                'title' => 'Failed',

                'value' => $this->repository
                    ->countBy(
                        'status',
                        'FAILED'
                    ),

                'description' => 'Download failed',

            ],

        ];
    }

    /**
     * Retrieve article pipeline.
     */
    public function findPipelineOrFailByUuid(
        string $uuid
    ): Article
    {
        return $this->repository
            ->findPipelineOrFailByUuid(
                $uuid
            );
    }
}