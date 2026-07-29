<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\ArticleStatus;
use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;

final class ArticleRepository extends BaseRepository
{
    protected array $searchable = [
        'title',
        'source',
        'language',
        'country',
        'keyword',
    ];

    protected array $filterable = [
        'status',
        'source',
        'language',
        'country',
        'scraper',
    ];

    protected array $sortable = [
        'title',
        'source',
        'published_at',
        'language',
        'country',
        'status',
        'scraped_at',
        'created_at',
    ];

    protected array $with = [
        'fullArticle',
    ];

    protected string $defaultSort = 'published_at';

    protected string $defaultDirection = 'desc';

    public function __construct(
        Article $model,
    ) {
        parent::__construct($model);
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    /**
     * Latest scraped article.
     */
    public function latestArticle(): ?Article
    {
        return $this->query()
            ->latest('published_at')
            ->first();
    }

    /**
     * Latest articles.
     */
    public function latestArticles(
        int $limit = 10,
    ): Collection {

        return $this->query()
            ->latest('published_at')
            ->limit($limit)
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Statistics
    |--------------------------------------------------------------------------
    */

    /**
     * Articles scraped today.
     */
    public function countToday(): int
    {
        return $this->query()
            ->whereDate('scraped_at', today())
            ->count();
    }

    /**
     * Number of unique news sources.
     */
    public function countSources(): int
    {
        return (int) $this->query()
            ->distinct('source')
            ->count('source');
    }

    /**
     * Count by processing status.
     */
    public function countByStatus(
        ArticleStatus $status,
    ): int {

        return $this->query()
            ->where('status', $status)
            ->count();
    }

    /*
    |--------------------------------------------------------------------------
    | Business Rules
    |--------------------------------------------------------------------------
    */

    /**
     * Check duplicate URL.
     */
    public function existsByUrlHash(
        string $hash,
    ): bool {

        return $this->exists([
            'url_hash' => $hash,
        ]);
    }

    /**
     * Find article by URL hash.
     */
    public function findByUrlHash(
        string $hash,
    ): ?Article {

        return $this->findBy(
            'url_hash',
            $hash,
        );
    }

    /**
     * Articles waiting for downloader.
     */
    public function pendingDownload(): Collection
    {
        return $this->query()
            ->where('status', ArticleStatus::PENDING)
            ->orderBy('created_at')
            ->get();
    }

    /**
     * Download completed.
     */
    public function downloaded(): Collection
    {
        return $this->query()
            ->where('status', ArticleStatus::DOWNLOADED)
            ->orderByDesc('scraped_at')
            ->get();
    }

    /**
     * Failed downloads.
     */
    public function failed(): Collection
    {
        return $this->query()
            ->where('status', ArticleStatus::FAILED)
            ->orderByDesc('created_at')
            ->get();
    }
}