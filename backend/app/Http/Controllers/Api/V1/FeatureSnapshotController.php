<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\FeatureSnapshot\StoreFeatureSnapshotRequest;
use App\Http\Requests\FeatureSnapshot\UpdateFeatureSnapshotRequest;
use App\Http\Resources\FeatureSnapshot\FeatureSnapshotResource;
use App\Services\FeatureSnapshotService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FeatureSnapshotController extends BaseApiController
{
    public function __construct(
        private readonly FeatureSnapshotService $service
    ) {
    }

    /**
     * Display paginated feature snapshots.
     */
    public function index(
        Request $request
    ): JsonResponse {

        $filters = $this->filters(
            $request,
            [
                'feature_version',
                'snapshot_date',
            ]
        );

        $features = $this->service->getPaginated(
            filters: $filters,
            search: $this->search($request),
            sort: $this->sort($request),
            direction: $this->direction($request),
            perPage: $this->perPage($request)
        );

        return $this->paginated(
            FeatureSnapshotResource::collection(
                $features
            )
        );

    }

    /**
     * Store a newly created feature snapshot.
     */
    public function store(
        StoreFeatureSnapshotRequest $request
    ): JsonResponse {

        $feature = $this->service->create(
            $request->validated()
        );

        return $this->created(
            new FeatureSnapshotResource(
                $feature
            )
        );

    }

    /**
     * Display a feature snapshot.
     */
    public function show(
        string $uuid
    ): JsonResponse {

        $feature = $this->service
            ->findByUuid($uuid);

        return $this->success(
            new FeatureSnapshotResource(
                $feature
            )
        );

    }

    /**
     * Update a feature snapshot.
     */
    public function update(
        UpdateFeatureSnapshotRequest $request,
        string $uuid
    ): JsonResponse {

        $this->service->update(
            $uuid,
            $request->validated()
        );

        return $this->updated(
            new FeatureSnapshotResource(
                $this->service->findByUuid($uuid)
            )
        );

    }

    /**
     * Delete a feature snapshot.
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