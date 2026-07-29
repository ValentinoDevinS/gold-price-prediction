<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\FeatureSnapshot;
use Illuminate\Database\Eloquent\Collection;

final class FeatureSnapshotRepository extends BaseRepository
{
    protected array $filterable = [

        'feature_version',

        'snapshot_date',

    ];

    protected array $sortable = [

        'snapshot_date',

        'generated_at',

        'created_at',

    ];

    protected string $defaultSort = 'snapshot_date';

    protected string $defaultDirection = 'desc';

    /**
     * Default eager loading.
     */
    protected array $with = [

        'sentimentAnalysis.cleanArticle.fullArticle.article',

        'predictionResults',

    ];

    public function __construct(
        FeatureSnapshot $model,
    ) {
        parent::__construct($model);
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public function latestFeature(): ?FeatureSnapshot
    {
        return $this->query()

            ->latest('generated_at')

            ->first();
    }

    public function latestFeatures(
        int $limit = 5,
    ): Collection {

        return $this->query()

            ->latest('generated_at')

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

            ->whereDate(
                'generated_at',
                today(),
            )

            ->count();
    }

    public function averageSentiment(): float
    {
        return (float) $this->query()

            ->avg(
                'average_sentiment',
            );
    }

    public function averageRollingSentiment7d(): float
    {
        return (float) $this->query()

            ->avg(
                'rolling_sentiment_7d',
            );
    }

    public function averageGoldPrice(): float
    {
        return (float) $this->query()

            ->avg(
                'gold_price',
            );
    }

    public function countPendingPrediction(): int
    {
        return $this->query()

            ->doesntHave(
                'predictionResults',
            )

            ->count();
    }

    public function countProcessedPrediction(): int
    {
        return $this->query()

            ->has(
                'predictionResults',
            )

            ->count();
    }

    /*
    |--------------------------------------------------------------------------
    | Business
    |--------------------------------------------------------------------------
    */

    public function findPendingPrediction(): Collection
    {
        return $this->query()

            ->doesntHave(
                'predictionResults',
            )

            ->orderBy(
                'generated_at',
            )

            ->get();
    }
}