<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\PredictionEvaluation;

final class PredictionEvaluationRepository extends BaseRepository
{
    public function __construct(
        PredictionEvaluation $model,
    ) {
        parent::__construct($model);
    }

    /**
     * Always eager load relationships.
     */
    protected array $with = [

        'predictionResult.featureSnapshot.sentimentAnalysis.cleanArticle.fullArticle.article',

    ];

    protected array $searchable = [

        'predictionResult.model_name',

        'predictionResult.model_version',

        'predictionResult.featureSnapshot.sentimentAnalysis.cleanArticle.fullArticle.article.title',

    ];

    protected array $filterable = [

        'actual_price_date',

        'predictionResult.model_name',

        'predictionResult.model_version',

    ];

    protected array $sortable = [

        'actual_price_date',

        'evaluated_at',

        'created_at',

        'percentage_error',

        'absolute_error',

    ];

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public function latestEvaluation(): ?PredictionEvaluation
    {
        return $this->model

            ->with($this->with)

            ->latest('evaluated_at')

            ->first();
    }

    public function latestEvaluations(
        int $limit = 10,
    ) {

        return $this->model

            ->with($this->with)

            ->latest('evaluated_at')

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
        return $this->model->count();
    }

    public function countToday(): int
    {
        return $this->model

            ->whereDate(
                'evaluated_at',
                today(),
            )

            ->count();
    }

    public function averageAbsoluteError(): float
    {
        return (float) $this->model

            ->avg('absolute_error');
    }

    public function averageSquaredError(): float
    {
        return (float) $this->model

            ->avg('squared_error');
    }

    public function averagePercentageError(): float
    {
        return (float) $this->model

            ->avg('percentage_error');
    }

    /*
    |--------------------------------------------------------------------------
    | Analytics
    |--------------------------------------------------------------------------
    */

    public function bestPerformingModel()
    {
        return $this->model

            ->selectRaw('prediction_results.model_name, AVG(percentage_error) as avg_error')

            ->join(
                'prediction_results',
                'prediction_results.id',
                '=',
                'prediction_evaluations.prediction_result_id',
            )

            ->groupBy('prediction_results.model_name')

            ->orderBy('avg_error')

            ->first();
    }

    public function worstPerformingModel()
    {
        return $this->model

            ->selectRaw('prediction_results.model_name, AVG(percentage_error) as avg_error')

            ->join(
                'prediction_results',
                'prediction_results.id',
                '=',
                'prediction_evaluations.prediction_result_id',
            )

            ->groupBy('prediction_results.model_name')

            ->orderByDesc('avg_error')

            ->first();
    }

    public function byModel(
        string $model,
    ) {

        return $this->model

            ->with($this->with)

            ->whereHas(
                'predictionResult',
                fn ($query) => $query->where(
                    'model_name',
                    $model,
                ),
            )

            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Evaluation Engine
    |--------------------------------------------------------------------------
    */

    public function findByPredictionResultId(
        int $predictionResultId,
    ): ?PredictionEvaluation {

        return $this->model

            ->where(
                'prediction_result_id',
                $predictionResultId,
            )

            ->first();
    }

    public function findByEnsembleResultId(
        int $ensembleResultId,
    ): ?PredictionEvaluation {

        return $this->model

            ->where(
                'ensemble_result_id',
                $ensembleResultId,
            )

            ->first();
    }
}