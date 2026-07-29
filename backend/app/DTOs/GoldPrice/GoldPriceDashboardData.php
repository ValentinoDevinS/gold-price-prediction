<?php

declare(strict_types=1);

namespace App\DTOs\GoldPrice;

final readonly class GoldPriceDashboardData
{
    /**
     * @param iterable<GoldPriceData> $prices
     */
    public function __construct(
        public ?GoldPriceData $latestPrice,
        public ?\Carbon\Carbon $latestDate,
        public iterable $prices,
    ) {
    }
}