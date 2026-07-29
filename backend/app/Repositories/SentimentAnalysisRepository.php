<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\SentimentLabel;
use App\Models\SentimentAnalysis;
use Illuminate\Database\Eloquent\Collection;

class SentimentAnalysisRepository extends BaseRepository
{
    protected array $searchable = [
        'model_name',
        'model_version',
    ];

    protected array $filterable = [
        'sentiment_label',
        'model_name',
    ];

    protected array $sortable = [
        'analyzed_at',
        'created_at',
    ];

    protected array $with = [
        'cleanArticle.fullArticle.article',
        'featureSnapshot',
    ];

    protected string $defaultSort = 'analyzed_at';

    protected string $defaultDirection = 'desc';

    public function __construct(
        SentimentAnalysis $model,
    ) {
        parent::__construct($model);
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public function latestSentiment(): ?SentimentAnalysis
    {
        return $this->latestOne();
    }

    public function latestSentiments(
        int $limit = 5,
    ): Collection {

        return $this->latest($limit);
    }

    /*
    |--------------------------------------------------------------------------
    | Statistics
    |--------------------------------------------------------------------------
    */

    public function countToday(): int
    {
        return $this->query()

            ->whereDate(
                'analyzed_at',
                today(),
            )

            ->count();
    }

    public function countPositive(): int
    {
        return $this->countBy(
            'sentiment_label',
            SentimentLabel::POSITIVE,
        );
    }

    public function countNeutral(): int
    {
        return $this->countBy(
            'sentiment_label',
            SentimentLabel::NEUTRAL,
        );
    }

    public function countNegative(): int
    {
        return $this->countBy(
            'sentiment_label',
            SentimentLabel::NEGATIVE,
        );
    }

    public function countPendingFeatureGeneration(): int
    {
        return $this->query()

            ->doesntHave(
                'featureSnapshot',
            )

            ->count();
    }

    public function countProcessedFeatureGeneration(): int
    {
        return $this->query()

            ->has(
                'featureSnapshot',
            )

            ->count();
    }

    /*
    |--------------------------------------------------------------------------
    | Pipeline
    |--------------------------------------------------------------------------
    */

    /**
     * Sentiment analyses waiting for Feature Engineering.
     */
    public function findPendingFeatureGeneration(): Collection
    {
        return $this->query()

            ->doesntHave(
                'featureSnapshot',
            )

            ->orderBy(
                'created_at',
            )

            ->get();
    }
}