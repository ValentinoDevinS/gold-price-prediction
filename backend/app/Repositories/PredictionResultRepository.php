<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\PredictionResult;
use Illuminate\Database\Eloquent\Collection;

final class PredictionResultRepository extends BaseRepository
{
    /**
     * Default eager loading.
     */
    protected array $with = [

        'featureSnapshot.sentimentAnalysis.cleanArticle.fullArticle.article',

        'evaluation',

    ];

    /**
     * Searchable columns.
     */
    protected array $searchable = [

        'model_name',

        'model_version',

    ];

    /**
     * Filterable columns.
     */
    protected array $filterable = [

        'model_name',

        'model_version',

        'prediction_date',

    ];

    /**
     * Sortable columns.
     */
    protected array $sortable = [

        'prediction_date',

        'predicted_at',

        'created_at',

        'updated_at',

    ];

    /**
     * Default sorting.
     */
    protected string $defaultSort = 'prediction_date';

    protected string $defaultDirection = 'desc';

    public function __construct(
        PredictionResult $model,
    ) {
        parent::__construct($model);
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public function latestPrediction(): ?PredictionResult
    {
        return $this->query()

            ->latest('predicted_at')

            ->first();
    }

    public function latestPredictions(
        int $limit = 5,
    ): Collection {

        return $this->query()

            ->latest('predicted_at')

            ->limit($limit)

            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Statistics
    |--------------------------------------------------------------------------
    */

    public function countAll(): int
    {
        return $this->query()->count();
    }

    public function countToday(): int
    {
        return $this->query()

            ->whereDate(
                'prediction_date',
                today(),
            )

            ->count();
    }

    public function averageConfidence(): float
    {
        return (float) (

            $this->query()

                ->avg(
                    'confidence_score',
                ) ?? 0

        );
    }

    public function averagePredictedPrice(): float
    {
        return (float) (

            $this->query()

                ->avg(
                    'predicted_price',
                ) ?? 0

        );
    }

    public function countEvaluated(): int
    {
        return $this->query()

            ->has(
                'evaluation',
            )

            ->count();
    }

    public function countPendingEvaluation(): int
    {
        return $this->query()

            ->doesntHave(
                'evaluation',
            )

            ->count();
    }

    /*
    |--------------------------------------------------------------------------
    | Business Queries
    |--------------------------------------------------------------------------
    */

    /**
     * Predictions waiting for evaluation.
     */
    public function findPendingEvaluation(): Collection
    {
        return $this->query()

            ->doesntHave(
                'evaluation',
            )

            ->oldest(
                'prediction_date',
            )

            ->get();
    }

    /**
     * Predictions belonging to one Feature Snapshot.
     */
    public function getByFeatureSnapshotId(
        int $featureSnapshotId,
    ): Collection {

        return $this->query()

            ->where(
                'feature_snapshot_id',
                $featureSnapshotId,
            )

            ->orderBy(
                'model_name',
            )

            ->get();
    }

    /**
     * Get predictions by model.
     */
    public function getByModel(
        string $modelName,
    ): Collection {

        return $this->query()

            ->where(
                'model_name',
                $modelName,
            )

            ->latest(
                'prediction_date',
            )

            ->get();
    }

    /**
     * Get the latest prediction set grouped by prediction date.
     */
    public function latestPredictionSet(): Collection
    {
        $featureSnapshotId = $this->query()

            ->latest('feature_snapshot_id')

            ->value('feature_snapshot_id');

        if ($featureSnapshotId === null) {
            return collect();
        }

        return $this->predictionSetByFeatureSnapshot(
            (int) $featureSnapshotId,
        );
    }

    /**
     * Get prediction set for one prediction date.
     */
    public function predictionSetByDate(
        string $predictionDate,
    ): Collection {

        return $this->query()

            ->whereDate(
                'prediction_date',
                $predictionDate,
            )

            ->orderBy(
                'model_name',
            )

            ->get();
    }

    /**
     * Get all predictions for one Feature Snapshot.
     */
    public function predictionSetByFeatureSnapshot(
        int $featureSnapshotId,
    ): Collection {

        return $this->query()

            ->where(
                'feature_snapshot_id',
                $featureSnapshotId,
            )

            ->orderBy(
                'model_name',
            )

            ->get();
    }
}