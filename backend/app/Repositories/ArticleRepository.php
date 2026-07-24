<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository extends BaseRepository
{
    protected array $searchable = [
        'title',
        'source',
        'keyword',
    ];

    protected array $filterable = [
        'status',
        'source',
        'country',
        'language',
        'scraper',
    ];

    protected array $sortable = [
        'published_at',
        'scraped_at',
        'created_at',
        'updated_at',
    ];

    protected string $defaultSort = 'published_at';

    protected string $defaultDirection = 'desc';

    public function __construct(Article $model)
    {
        parent::__construct($model);
    }

    /**
     * Check whether an article already exists by URL hash.
     */
    public function findByUrlHash(string $urlHash): ?Article
    {
        return $this->findBy(
            'url_hash',
            $urlHash
        );
    }

    /**
     * Retrieve article pipeline or fail.
     */
    public function findPipelineOrFailByUuid(
        string $uuid
    ): Article {

        return $this->query()

            ->with([
                'fullArticle.cleanArticle.sentimentAnalysis.featureSnapshot.predictionResults.evaluation',
            ])

            ->where(
                'uuid',
                $uuid
            )

            ->firstOrFail();

    }
}