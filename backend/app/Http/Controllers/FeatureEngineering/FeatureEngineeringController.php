<?php

declare(strict_types=1);

namespace App\Http\Controllers\FeatureEngineering;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeatureEngineering\FeatureEngineeringIndexRequest;
use App\Http\Requests\FeatureEngineering\FeatureEngineeringShowRequest;
use App\Services\FeatureEngineering\FeatureEngineeringDashboardService;
use App\Services\FeatureEngineering\FeatureEngineeringQueryService;

final class FeatureEngineeringController extends Controller
{
    public function __construct(
        private readonly FeatureEngineeringDashboardService $dashboardService,
        private readonly FeatureEngineeringQueryService $queryService,
    ) {
    }

    /**
     * Display the Feature Engineering dashboard.
     */
    public function index(
        FeatureEngineeringIndexRequest $request,
    ) {

        $dashboard = $this->dashboardService
            ->getDashboard(

                perPage: (int) $request->validated(
                    'per_page',
                    20,
                ),

            );

        return view(
            'feature-engineering.index',
            compact('dashboard'),
        );
    }

    /**
     * Display Feature Engineering details.
     */
    public function show(
        FeatureEngineeringShowRequest $request,
        string $uuid,
    ) {

        $feature = $this->queryService
            ->findByUuid($uuid);

        abort_if(
            $feature === null,
            404,
        );

        return view(
            'feature-engineering.show',
            compact('feature'),
        );
    }
}