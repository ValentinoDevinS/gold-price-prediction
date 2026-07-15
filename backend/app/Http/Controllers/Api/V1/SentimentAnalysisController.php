<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\SentimentAnalysis\StoreSentimentAnalysisRequest;
use App\Http\Requests\SentimentAnalysis\UpdateSentimentAnalysisRequest;
use App\Http\Resources\SentimentAnalysis\SentimentAnalysisResource;
use App\Services\SentimentAnalysisService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SentimentAnalysisController extends BaseApiController
{
    public function __construct(
        private readonly SentimentAnalysisService $service
    ) {
    }

    /**
     * Display paginated sentiment analyses.
     */
    public function index(
        Request $request
    ): JsonResponse {

        $filters = $this->filters(
            $request,
            [
                'sentiment_label',
                'model_name',
            ]
        );

        $sentiments = $this->service->getPaginated(
            filters: $filters,
            search: $this->search($request),
            sort: $this->sort($request),
            direction: $this->direction($request),
            perPage: $this->perPage($request)
        );

        return $this->paginated(
            SentimentAnalysisResource::collection(
                $sentiments
            )
        );

    }

    /**
     * Store a newly created sentiment analysis.
     */
    public function store(
        StoreSentimentAnalysisRequest $request
    ): JsonResponse {

        $sentiment = $this->service->create(
            $request->validated()
        );

        return $this->created(
            new SentimentAnalysisResource(
                $sentiment
            )
        );

    }

    /**
     * Display a sentiment analysis.
     */
    public function show(
        string $uuid
    ): JsonResponse {

        $sentiment = $this->service
            ->findByUuid($uuid);

        return $this->success(
            new SentimentAnalysisResource(
                $sentiment
            )
        );

    }

    /**
     * Update a sentiment analysis.
     */
    public function update(
        UpdateSentimentAnalysisRequest $request,
        string $uuid
    ): JsonResponse {

        $this->service->update(
            $uuid,
            $request->validated()
        );

        return $this->updated(
            new SentimentAnalysisResource(
                $this->service->findByUuid($uuid)
            )
        );

    }

    /**
     * Delete a sentiment analysis.
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