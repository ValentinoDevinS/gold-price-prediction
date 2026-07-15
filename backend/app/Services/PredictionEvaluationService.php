<?php

namespace App\Services;

use App\Models\EnsembleResult;
use App\Models\PredictionEvaluation;
use App\Models\PredictionResult;
use App\Repositories\EnsembleResultRepository;
use App\Repositories\PredictionEvaluationRepository;
use App\Repositories\PredictionResultRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class PredictionEvaluationService extends BaseService
{
    public function __construct(
        private readonly PredictionEvaluationRepository $repository,
        private readonly PredictionResultRepository $predictionRepository,
        private readonly EnsembleResultRepository $ensembleRepository,
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | Public API
    |--------------------------------------------------------------------------
    */

    public function evaluatePredictionResult(
        string $predictionUuid,
        array $evaluationData
    ): PredictionEvaluation {

        return $this->execute(function () use (
            $predictionUuid,
            $evaluationData
        ) {

            $prediction =

                $this->predictionRepository
                    ->findOrFailByUuid(
                        $predictionUuid
                    );

            return $this->evaluate(
                prediction: $prediction,
                evaluationData: $evaluationData,
                isEnsemble: false
            );

        });

    }

    public function evaluateEnsembleResult(
        string $ensembleUuid,
        array $evaluationData
    ): PredictionEvaluation {

        return $this->execute(function () use (
            $ensembleUuid,
            $evaluationData
        ) {

            $ensemble =

                $this->ensembleRepository
                    ->findOrFailByUuid(
                        $ensembleUuid
                    );

            return $this->evaluate(
                prediction: $ensemble,
                evaluationData: $evaluationData,
                isEnsemble: true
            );

        });

    }

    public function delete(
        string $uuid
    ): bool {

        return $this->execute(function () use ($uuid) {

            $evaluation =

                $this->repository
                    ->findOrFailByUuid(
                        $uuid
                    );

            return $this->repository
                ->delete(
                    $evaluation
                );

        });

    }

    public function findByUuid(
        string $uuid
    ): PredictionEvaluation {

        return

            $this->repository
                ->findOrFailByUuid(
                    $uuid
                );

    }

    public function getPaginated(
        array $filters = [],
        ?string $search = null,
        ?string $sort = null,
        ?string $direction = null,
        int $perPage = 20
    ): LengthAwarePaginator {

        return

            $this->repository
                ->getPaginated(
                    filters: $filters,
                    search: $search,
                    sort: $sort,
                    direction: $direction,
                    perPage: $perPage
                );

    }

    /*
    |--------------------------------------------------------------------------
    | Evaluation Engine
    |--------------------------------------------------------------------------
    */

    private function evaluate(
        PredictionResult|EnsembleResult $prediction,
        array $evaluationData,
        bool $isEnsemble
    ): PredictionEvaluation {

        $errors =

            $this->calculateErrors(

                predictedPrice:
                    $prediction->predicted_price,

                actualPrice:
                    $evaluationData['actual_price']

            );

        return

            $this->storeEvaluation(

                prediction: $prediction,

                evaluationData: $evaluationData,

                errors: $errors,

                isEnsemble: $isEnsemble

            );

    }

    /*
    |--------------------------------------------------------------------------
    | Error Calculation
    |--------------------------------------------------------------------------
    */

    private function calculateErrors(
        float $predictedPrice,
        float $actualPrice
    ): Collection {

        $difference =

            $predictedPrice
            -
            $actualPrice;

        $absoluteError =

            abs(
                $difference
            );

        $squaredError =

            pow(
                $difference,
                2
            );

        $percentageError =

            $actualPrice == 0

                ? 0

                : (

                    $absoluteError
                    /
                    $actualPrice

                ) * 100;

        return collect([

            'absolute_error'

                =>

                round(
                    $absoluteError,
                    6
                ),

            'squared_error'

                =>

                round(
                    $squaredError,
                    6
                ),

            'percentage_error'

                =>

                round(
                    $percentageError,
                    6
                ),

        ]);

    }

    /*
    |--------------------------------------------------------------------------
    | Storage
    |--------------------------------------------------------------------------
    */

    private function storeEvaluation(
        PredictionResult|EnsembleResult $prediction,
        array $evaluationData,
        Collection $errors,
        bool $isEnsemble
    ): PredictionEvaluation {

        $existing =

            $isEnsemble

                ?

                $this->repository
                    ->findByEnsembleResultId(
                        $prediction->id
                    )

                :

                $this->repository
                    ->findByPredictionResultId(
                        $prediction->id
                    );

        $data = [

            'prediction_result_id'

                =>

                $isEnsemble

                    ? null

                    : $prediction->id,

            'ensemble_result_id'

                =>

                $isEnsemble

                    ? $prediction->id

                    : null,

            'actual_price'

                =>

                $evaluationData['actual_price'],

            'actual_price_date'

                =>

                $evaluationData['actual_price_date'],

            'absolute_error'

                =>

                $errors->get(
                    'absolute_error'
                ),

            'squared_error'

                =>

                $errors->get(
                    'squared_error'
                ),

            'percentage_error'

                =>

                $errors->get(
                    'percentage_error'
                ),

            'evaluated_at'

                =>

                now(),

        ];

        if ($existing) {

            $this->repository
                ->update(
                    $existing,
                    $data
                );

            return $existing->fresh();

        }

        return

            $this->repository
                ->create(
                    $data
                );

    }

}