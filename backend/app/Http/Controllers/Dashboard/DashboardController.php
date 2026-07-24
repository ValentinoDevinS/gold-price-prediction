<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\DashboardService;
use Illuminate\Contracts\View\View;

final class DashboardController extends Controller
{
    public function __construct(
        private readonly DashboardService $dashboardService,
    ) {
    }

    public function index(): View
    {
        return view('dashboard.index', [
            'statistics' => $this->dashboardService->statistics(),
            'latestArticles' => $this->dashboardService->latestArticles(),
        ]);
    }
}