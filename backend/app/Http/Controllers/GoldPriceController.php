<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\GoldPrice\GoldPriceIndexRequest;
use App\Http\Requests\GoldPrice\GoldPriceShowRequest;
use App\Services\GoldPrice\GoldPriceDashboardService;
use App\Services\GoldPrice\GoldPriceQueryService;
use App\Services\GoldPrice\GoldPriceStatisticService;
use Illuminate\Contracts\View\View;

final class GoldPriceController extends Controller
{
    public function __construct(
        private readonly GoldPriceDashboardService $dashboardService,
        private readonly GoldPriceQueryService $queryService,
        private readonly GoldPriceStatisticService $statisticService,
    ) {
    }

    /**
     * Gold Price Dashboard.
     */
    public function index(
        GoldPriceIndexRequest $request,
    ): View {
        return view('gold-price.index', [
            'dashboard' => $this->dashboardService->dashboard($request),
        ]);
    }

    /**
     * Gold Price Detail.
     */
    public function show(
        GoldPriceShowRequest $request,
        string $date,
    ): View {
        return view('gold-price.show', [
            'goldPrice' => $this->queryService->findByDate($date),
        ]);
    }
}