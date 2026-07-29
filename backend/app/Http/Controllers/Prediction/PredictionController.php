<?php

declare(strict_types=1);

namespace App\Http\Controllers\Prediction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Prediction\PredictionIndexRequest;
use App\Http\Requests\Prediction\PredictionShowRequest;
use App\Services\Prediction\PredictionDashboardService;
use App\Services\Prediction\PredictionQueryService;
use Illuminate\Contracts\View\View;

final class PredictionController extends Controller
{
    public function __construct(
        private readonly PredictionDashboardService $dashboardService,
        private readonly PredictionQueryService $queryService,
    ) {
    }

    /**
     * Display prediction dashboard.
     */
    public function index(
        PredictionIndexRequest $request,
    ): View {

        $dashboard = $this->dashboardService->getDashboard(

            filters: $request->only([
                'model_name',
                'model_version',
                'prediction_date',
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
            'prediction.index',
            compact('dashboard'),
        );
    }

    /**
     * Display prediction detail.
     */
    public function show(
        PredictionShowRequest $request,
        string $uuid,
    ): View {

        $prediction = $this->queryService
            ->findByUuid($uuid);

        abort_if(
            $prediction === null,
            404,
        );

        return view(
            'prediction.show',
            compact('prediction'),
        );
    }
}