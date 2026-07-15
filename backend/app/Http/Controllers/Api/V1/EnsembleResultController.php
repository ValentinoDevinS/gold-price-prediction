<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Resources\EnsembleResult\EnsembleResultResource;
use App\Models\EnsembleResult;
use App\Services\EnsembleResultService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnsembleResultController extends BaseApiController
{
    public function __construct(
        private readonly EnsembleResultService $service
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | Read
    |--------------------------------------------------------------------------
    */

    public function index(
        Request $request
    ): JsonResponse {

        $filters = $this->filters(
            $request,
            [
                'ensemble_method',
                'model_version',
                'prediction_date',
            ]
        );

        $results = $this->service->getPaginated(
            filters: $filters,
            search: $this->search($request),
            sort: $this->sort($request),
            direction: $this->direction($request),
            perPage: $this->perPage($request)
        );

        return $this->paginated(
            EnsembleResultResource::collection(
                $results
            )
        );

    }

    public function show(
        string $uuid
    ): JsonResponse {

        return $this->success(
            new EnsembleResultResource(

                $this->service
                    ->findByUuid($uuid)

            )
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Generate
    |--------------------------------------------------------------------------
    */

    public function generate(
        string $featureSnapshotUuid
    ): JsonResponse {

        $ensemble =

            $this->service
                ->generateFromFeatureSnapshot(
                    $featureSnapshotUuid,
                    EnsembleResult::METHOD_AVERAGE
                );

        return $this->created(

            new EnsembleResultResource(
                $ensemble
            )

        );

    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function destroy(
        string $uuid
    ): JsonResponse {

        $this->service
            ->delete($uuid);

        return $this->deleted();

    }
}