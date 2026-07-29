<?php

declare(strict_types=1);

namespace App\Data\GoldPrice;

use App\Data\Ui\TableData;
use Carbon\Carbon;
use Illuminate\Support\Collection;

final readonly class GoldPriceDashboardData
{
    public function __construct(
        public ?GoldPriceData $latestPrice,

        public ?Carbon $latestDate,

        public Collection $prices,

        public TableData $table,
    ) {
    }
}