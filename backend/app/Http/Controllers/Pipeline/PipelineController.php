<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pipeline;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pipeline\PipelineIndexRequest;
use App\Services\Pipeline\PipelineDashboardService;
use Illuminate\Contracts\View\View;

final class PipelineController extends Controller
{
    public function __construct(
        private readonly PipelineDashboardService $dashboardService,
    ) {
    }

    /**
     * Display the pipeline monitor dashboard.
     */
    public function index(
        PipelineIndexRequest $request,
    ): View {

        $dashboard = $this->dashboardService->getDashboard();

        return view(
            'pipeline.index',
            compact('dashboard'),
        );

    }
}