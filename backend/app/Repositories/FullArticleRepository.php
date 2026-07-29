<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\FullArticle;
use Illuminate\Database\Eloquent\Collection;

final class FullArticleRepository extends BaseRepository
{
    protected array $searchable = [
        'content',
        'author',
    ];

    protected array $filterable = [
        'download_status',
    ];

    protected array $sortable = [
        'downloaded_at',
        'created_at',
        'updated_at',
        'word_count',
    ];

    protected array $with = [
        'article',
    ];

    protected string $defaultSort = 'downloaded_at';

    public function __construct(
        FullArticle $model,
    ) {
        parent::__construct($model);
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public function latest(): ?FullArticle
    {
        return $this->query()
            ->latest('downloaded_at')
            ->first();
    }

    /*
    |--------------------------------------------------------------------------
    | Statistics
    |--------------------------------------------------------------------------
    */

    public function countDownloaded(): int
    {
        return $this->query()
            ->where('download_status', 'downloaded')
            ->count();
    }

    public function countPending(): int
    {
        return $this->query()
            ->where('download_status', 'pending')
            ->count();
    }

    public function countFailed(): int
    {
        return $this->query()
            ->where('download_status', 'failed')
            ->count();
    }

    public function totalWords(): int
    {
        return (int) $this->query()
            ->sum('word_count');
    }

    /*
    |--------------------------------------------------------------------------
    | Business Queries
    |--------------------------------------------------------------------------
    */

    public function findByUuid(
        string $uuid,
    ): ?FullArticle {

        return $this->query()
            ->where('uuid', $uuid)
            ->first();

    }

    /**
     * Retrieve downloaded articles waiting for cleaning.
     *
     * @return Collection<int, FullArticle>
     */
    public function findPendingCleaning(): Collection
    {
        return $this->query()
            ->whereDoesntHave('cleanArticle')
            ->orderBy('created_at')
            ->get();
    }
}