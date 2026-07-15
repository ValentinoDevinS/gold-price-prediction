<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\PredictionResult\StorePredictionResultRequest;
use App\Http\Requests\PredictionResult\UpdatePredictionResultRequest;
use App\Http\Resources\PredictionResult\PredictionResultResource;
use App\Services\PredictionResultService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PredictionResultController extends BaseApiController
{
    public function __construct(
        private readonly PredictionResultService $service
    ) {
    }

    /**
     * Display paginated Prediction Result.
     */
    public function index(
        Request $request
    ): JsonResponse {

        $filters = $this->filters(
            $request,
            [
                'model_name',
                'model_version',
                'prediction_date',
            ]
        );

        $prediction = $this->service->getPaginated(
            filters: $filters,
            search: $this->search($request),
            sort: $this->sort($request),
            direction: $this->direction($request),
            perPage: $this->perPage($request)
        );

        return $this->paginated(
            PredictionResultResource::collection(
                $prediction
            )
        );

    }

    /**
     * Store a newly created Prediction Result.
     */
    public function store(
        StorePredictionResultRequest $request
    ): JsonResponse {

        $prediction = $this->service->create(
            $request->validated()
        );

        return $this->created(
            new PredictionResultResource(
                $prediction
            )
        );

    }

    /**
     * Display a Prediction Result
     */
    public function show(
        string $uuid
    ): JsonResponse {

        $prediction = $this->service
            ->findByUuid($uuid);

        return $this->success(
            new PredictionResultResource(
                $prediction
            )
        );

    }

    /**
     * Update a Prediction Result.
     */
    public function update(
        UpdatePredictionResultRequest $request,
        string $uuid
    ): JsonResponse {

        $this->service->update(
            $uuid,
            $request->validated()
        );

        return $this->updated(
            new PredictionResultResource(
                $this->service->findByUuid($uuid)
            )
        );

    }

    /**
     * Delete a Prediction Result.
     */
    public function destroy(
        string $uuid
    ): JsonResponse {

        $this->service->delete(
            $uuid
        );

        return $this->deleted();

    }
}
