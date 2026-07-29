<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\CleanArticle;
use Illuminate\Database\Eloquent\Collection;

final class CleanArticleRepository extends BaseRepository
{
    protected array $searchable = [
        'clean_content',
    ];

    protected array $sortable = [
        'cleaned_at',
        'created_at',
    ];

    protected array $with = [
        'fullArticle.article',
        'sentimentAnalysis',
    ];

    protected string $defaultSort = 'cleaned_at';

    protected string $defaultDirection = 'desc';

    public function __construct(
        CleanArticle $model,
    ) {
        parent::__construct($model);
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public function latestCleanArticle(): ?CleanArticle
    {
        return $this->query()
            ->latest('cleaned_at')
            ->first();
    }

    public function latestCleanArticles(
        int $limit = 10,
    ): Collection {

        return $this->query()
            ->latest('cleaned_at')
            ->limit($limit)
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Statistics
    |--------------------------------------------------------------------------
    */

    public function countToday(): int
    {
        return $this->query()
            ->whereDate('cleaned_at', today())
            ->count();
    }

    public function averageOriginalWordCount(): int
    {
        return (int) round(
            $this->query()->avg('original_word_count') ?? 0
        );
    }

    public function averageCleanWordCount(): int
    {
        return (int) round(
            $this->query()->avg('clean_word_count') ?? 0
        );
    }

    public function countPendingSentiment(): int
    {
        return $this->query()
            ->whereDoesntHave('sentimentAnalysis')
            ->count();
    }

    public function countProcessedSentiment(): int
    {
        return $this->query()
            ->whereHas('sentimentAnalysis')
            ->count();
    }

    /*
    |--------------------------------------------------------------------------
    | Business Rules
    |--------------------------------------------------------------------------
    */

    /**
     * Retrieve clean articles waiting for sentiment analysis.
     */
    public function findPendingSentiment(): Collection
    {
        return $this->query()
            ->whereDoesntHave('sentimentAnalysis')
            ->orderBy('created_at')
            ->get();
    }
}