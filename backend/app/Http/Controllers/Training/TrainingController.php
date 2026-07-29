<?php

declare(strict_types=1);

namespace App\Http\Controllers\Training;

use App\Http\Controllers\Controller;
use App\Http\Requests\Training\TrainingIndexRequest;
use App\Services\Training\TrainingDashboardService;
use Illuminate\Contracts\View\View;

final class TrainingController extends Controller
{
    public function __construct(
        private readonly TrainingDashboardService $dashboardService,
    ) {
    }

    /**
     * Training dashboard.
     */
    public function index(
        TrainingIndexRequest $request,
    ): View {

        $dashboard = $this->dashboardService->build($request);

        return view(
            'training.index',
            [
                'dashboard' => $dashboard,
            ]
        );
    }
}