<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Resources\ModelStatistic\ModelStatisticResource;
use App\Services\ModelStatisticService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ModelStatisticController extends BaseApiController
{
    public function __construct(
        private readonly ModelStatisticService $service
    ) {
    }

    /**
     * Display model statistics.
     */
    public function index(
        Request $request
    ): JsonResponse
    {
        $filters = $this->filters(
            $request,
            [
                'model_name',
            ]
        );

        $statistics =

            $this->service
                ->getPaginated(

                    filters: $filters,

                    search: $this->search($request),

                    sort: $this->sort($request),

                    direction: $this->direction($request),

                    perPage: $this->perPage($request)

                );

        return $this->paginated(

            ModelStatisticResource::collection(
                $statistics
            )

        );
    }

    /**
     * Display one model statistic.
     */
    public function show(
        string $uuid
    ): JsonResponse
    {
        return $this->success(

            new ModelStatisticResource(

                $this->service
                    ->findByUuid($uuid)

            )

        );
    }

    /**
     * Display leaderboard.
     */
    public function leaderboard(): JsonResponse
    {
        return $this->success(

            ModelStatisticResource::collection(

                $this->service
                    ->leaderboard()

            )

        );
    }

    /**
     * Dashboard summary.
     */
    public function dashboard(): JsonResponse
    {
        return $this->success(

            $this->service
                ->dashboard()

        );
    }

    /**
     * Refresh statistics.
     */
    public function refresh(): JsonResponse
    {
        $this->service
            ->recalculateAllModels();

        return $this->success([

            'message'

                =>

                'Model statistics refreshed successfully.',

            'leaderboard'

                =>

                ModelStatisticResource::collection(

                    $this->service
                        ->leaderboard()

                )

        ]);
    }

    /**
     * Delete statistic.
     */
    public function destroy(
        string $uuid
    ): JsonResponse
    {
        $this->service
            ->delete($uuid);

        return $this->deleted();
    }
}