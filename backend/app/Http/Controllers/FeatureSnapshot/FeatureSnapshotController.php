<?php

namespace App\Http\Controllers\FeatureSnapshot;

use App\Http\Controllers\Controller;
use App\Services\FeatureSnapshotService;
use Illuminate\Http\Request;

class FeatureSnapshotController extends Controller
{
    public function __construct(
        private readonly FeatureSnapshotService $service
    ) {
    }

    /**
     * Display a paginated list of feature snapshots.
     */
    public function index(Request $request)
    {
        $features = $this->service->getPaginated(
            filters: array_filter([
                'feature_version' => $request->input('feature_version'),
                'snapshot_date'   => $request->input('snapshot_date'),
            ]),
            sort: $request->input('sort'),
            direction: $request->input('direction'),
            perPage: (int) $request->input('per_page', 20),
        );

        return view(
            'feature-snapshots.index',
            compact('features')
        );
    }

    /**
     * Display a single feature snapshot.
     */
    public function show(string $uuid)
    {
        $feature = $this->service
            ->findByUuid($uuid);

        return view(
            'feature-snapshots.show',
            compact('feature')
        );
    }
}