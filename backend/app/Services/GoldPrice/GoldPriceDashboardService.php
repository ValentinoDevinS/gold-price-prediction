<?php

declare(strict_types=1);

namespace App\Services\GoldPrice;

use App\Data\GoldPrice\GoldPriceDashboardData;
use App\Http\Requests\GoldPrice\GoldPriceIndexRequest;

final readonly class GoldPriceDashboardService
{
    public function __construct(
        private GoldPriceQueryService $queryService,
        private GoldPriceTableService $tableService,
    ) {
    }

    public function dashboard(
        GoldPriceIndexRequest $request,
    ): GoldPriceDashboardData {
        $rows = $this->queryService->paginate($request);

        return new GoldPriceDashboardData(
            latestPrice: $this->queryService->latest(),

            latestDate: $this->queryService->latestDate(),

            prices: collect($rows->items()),

            table: $this->tableService->build($rows),
        );
    }
}