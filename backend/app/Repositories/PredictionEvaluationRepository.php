<?php

namespace App\Repositories;

use App\Models\PredictionEvaluation;
use Illuminate\Database\Eloquent\Collection;

class PredictionEvaluationRepository extends BaseRepository
{
    protected function model(): string
    {
        return PredictionEvaluation::class;
    }

    protected array $searchable = [

    ];

    protected array $filterable = [

        'actual_price_date',

    ];

    protected array $sortable = [

        'actual_price_date',

        'evaluated_at',

        'created_at',

    ];

    /**
     * Find evaluation by Prediction Result ID.
     */
    public function findByPredictionResultId(
        int $predictionResultId
    ): ?PredictionEvaluation {

        return $this->model
            ->where(
                'prediction_result_id',
                $predictionResultId
            )
            ->first();

    }

    /**
     * Find evaluation by Ensemble Result ID.
     */
    public function findByEnsembleResultId(
        int $ensembleResultId
    ): ?PredictionEvaluation {

        return $this->model
            ->where(
                'ensemble_result_id',
                $ensembleResultId
            )
            ->first();

    }

    /**
     * Get all evaluations for one model.
     */
    public function getByModelName(
        string $modelName
    ): Collection
    {
        return $this->model

            ->with(
                'predictionResult'
            )

            ->whereHas(
                'predictionResult',
                function ($query) use ($modelName) {

                    $query->where(
                        'model_name',
                        $modelName
                    );

                }
            )

            ->get();
    }

    /**
     * Group evaluations by actual price date.
     */
    public function getGroupedByActualPriceDate(): Collection
    {
        return

            $this->model

                ->with(
                    'predictionResult'
                )

                ->get()

                ->groupBy(
                    'actual_price_date'
                );
    }
}