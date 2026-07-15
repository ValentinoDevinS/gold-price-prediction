<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Resources\ModelStatisticHistory\ModelStatisticHistoryResource;
use App\Services\ModelStatisticHistoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ModelStatisticHistoryController extends BaseApiController
{
    public function __construct(
        private readonly ModelStatisticHistoryService $service
    ) {
    }

    /**
     * Display history.
     */
    public function index(
        Request $request
    ): JsonResponse {

        $filters =

            $this->filters(

                $request,

                [

                    'model_name',

                    'snapshot_sequence',

                    'snapshot_date',

                    'evaluation_scope',

                ]

            );

        $history =

            $this->service
                ->getPaginated(

                    filters: $filters,

                    search: $this->search($request),

                    sort: $this->sort($request),

                    direction: $this->direction($request),

                    perPage: $this->perPage($request),

                );

        return

            $this->paginated(

                ModelStatisticHistoryResource::collection(

                    $history

                )

            );

    }

    /**
     * Display one history.
     */
    public function show(
        string $uuid
    ): JsonResponse {

        return

            $this->success(

                new ModelStatisticHistoryResource(

                    $this->service
                        ->findByUuid(
                            $uuid
                        )

                )

            );

    }

    /**
     * Delete history.
     */
    public function destroy(
        string $uuid
    ): JsonResponse {

        $this->service
            ->delete(
                $uuid
            );

        return

            $this->deleted();

    }
}