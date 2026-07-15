<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\PredictionEvaluation\StorePredictionEvaluationRequest;
use App\Http\Resources\PredictionEvaluation\PredictionEvaluationResource;
use App\Services\PredictionEvaluationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PredictionEvaluationController extends BaseApiController
{
    public function __construct(
        private readonly PredictionEvaluationService $service
    ) {
    }

    /**
     * Display evaluations.
     */
    public function index(
        Request $request
    ): JsonResponse {

        $evaluations =

            $this->service
                ->getPaginated(

                    filters: $this->filters(
                        $request,
                        [
                            'actual_price_date',
                        ]
                    ),

                    search: $this->search($request),

                    sort: $this->sort($request),

                    direction: $this->direction($request),

                    perPage: $this->perPage($request)

                );

        return $this->paginated(

            PredictionEvaluationResource::collection(
                $evaluations
            )

        );

    }

    /**
     * Display evaluation.
     */
    public function show(
        string $uuid
    ): JsonResponse {

        return $this->success(

            new PredictionEvaluationResource(

                $this->service
                    ->findByUuid(
                        $uuid
                    )

            )

        );

    }

    /**
     * Evaluate Prediction Result.
     */
    public function evaluatePredictionResult(
        StorePredictionEvaluationRequest $request,
        string $predictionUuid
    ): JsonResponse {

        $evaluation =

            $this->service
                ->evaluatePredictionResult(

                    $predictionUuid,

                    $request->validated()

                );

        return $this->created(

            new PredictionEvaluationResource(
                $evaluation
            )

        );

    }

    /**
     * Evaluate Ensemble Result.
     */
    public function evaluateEnsembleResult(
        StorePredictionEvaluationRequest $request,
        string $ensembleUuid
    ): JsonResponse {

        $evaluation =

            $this->service
                ->evaluateEnsembleResult(

                    $ensembleUuid,

                    $request->validated()

                );

        return $this->created(

            new PredictionEvaluationResource(
                $evaluation
            )

        );

    }

    /**
     * Delete evaluation.
     */
    public function destroy(
        string $uuid
    ): JsonResponse {

        $this->service
            ->delete(
                $uuid
            );

        return $this->deleted();

    }
}