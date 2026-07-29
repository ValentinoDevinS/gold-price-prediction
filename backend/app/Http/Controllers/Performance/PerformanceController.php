<?php

declare(strict_types=1);

namespace App\Http\Controllers\Performance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Performance\PerformanceIndexRequest;
use App\Http\Requests\Performance\PerformanceShowRequest;
use App\Services\Performance\PerformanceDashboardService;
use App\Services\Performance\PerformanceQueryService;

final class PerformanceController extends Controller
{
    public function __construct(
        private readonly PerformanceDashboardService $dashboardService,
        private readonly PerformanceQueryService $queryService,
    ) {
    }

    /**
     * Display the Performance dashboard.
     */
    public function index(
        PerformanceIndexRequest $request,
    ) {

        $dashboard = $this->dashboardService->getDashboard(

            filters: $request->only([
                'model_name',
                'model_version',
                'actual_price_date',
            ]),

            search: $request->validated('search'),

            sort: $request->validated('sort'),

            direction: $request->validated('direction'),

            perPage: (int) $request->validated(
                'per_page',
                20,
            ),

        );

        return view(
            'performance.index',
            compact('dashboard'),
        );
    }

    /**
     * Display a Performance record.
     */
    public function show(
        PerformanceShowRequest $request,
        string $uuid,
    ) {

        $performance = $this->queryService
            ->findByUuid($uuid);

        abort_if(
            $performance === null,
            404,
        );

        return view(
            'performance.show',
            compact('performance'),
        );
    }
}