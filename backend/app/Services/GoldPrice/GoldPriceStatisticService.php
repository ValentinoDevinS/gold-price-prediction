<?php

declare(strict_types=1);

namespace App\Services\GoldPrice;

use App\DTOs\GoldPrice\GoldPriceData;
use Carbon\Carbon;

final readonly class GoldPriceStatisticService
{
    public function __construct(
        private GoldPriceQueryService $queryService,
    ) {
    }

    /**
     * Latest gold price.
     */
    public function latestPrice(): ?GoldPriceData
    {
        return $this->queryService->latest();
    }

    /**
     * Latest trading date.
     */
    public function latestDate(): ?Carbon
    {
        return $this->queryService->latestDate();
    }

    /**
     * Determine whether today's data exists.
     */
    public function hasTodayPrice(): bool
    {
        return $this->queryService->existsByDate(
            Carbon::today()
        );
    }

    /**
     * Latest 30 trading days.
     */
    public function latestThirtyDays()
    {
        return $this->queryService->latestMany(30);
    }
}