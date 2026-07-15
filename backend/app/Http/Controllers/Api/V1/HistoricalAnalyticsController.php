<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\HistoricalAnalyticsService;
use Illuminate\Http\JsonResponse;

class HistoricalAnalyticsController extends Controller
{
    public function __construct(
        private readonly HistoricalAnalyticsService $service,
    ) {
    }

    /**
     * Dashboard.
     */
    public function index(): JsonResponse
    {
        return response()->json(

            $this->service
                ->getDashboard()

        );
    }

    /**
     * Summary.
     */
    public function summary(): JsonResponse
    {
        return response()->json(

            $this->service
                ->getSummary()

        );
    }

    /**
     * Trends.
     */
    public function trend(): JsonResponse
    {
        return response()->json(

            $this->service
                ->getTrend()

        );
    }

    /**
     * Comparison.
     */
    public function comparison(): JsonResponse
    {
        return response()->json(

            $this->service
                ->getComparison()

        );
    }
}