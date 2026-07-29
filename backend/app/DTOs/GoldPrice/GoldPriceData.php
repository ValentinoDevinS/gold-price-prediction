<?php

declare(strict_types=1);

namespace App\DTOs\GoldPrice;

use App\Models\GoldPrice;
use Carbon\Carbon;

final readonly class GoldPriceData
{
    public function __construct(
        public string $uuid,
        public Carbon $priceDate,

        public float $openPrice,
        public float $highPrice,
        public float $lowPrice,
        public float $closePrice,
        public float $adjustedClosePrice,

        public int $volume,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            uuid: $data['uuid'],
            priceDate: Carbon::parse($data['price_date']),
            openPrice: (float) $data['open_price'],
            highPrice: (float) $data['high_price'],
            lowPrice: (float) $data['low_price'],
            closePrice: (float) $data['close_price'],
            adjustedClosePrice: (float) $data['adjusted_close_price'],
            volume: (int) $data['volume'],
        );
    }

    public static function fromModel(GoldPrice $goldPrice): self
    {
        return new self(
            uuid: $goldPrice->uuid,
            priceDate: Carbon::parse($goldPrice->price_date),
            openPrice: (float) $goldPrice->open_price,
            highPrice: (float) $goldPrice->high_price,
            lowPrice: (float) $goldPrice->low_price,
            closePrice: (float) $goldPrice->close_price,
            adjustedClosePrice: (float) $goldPrice->adjusted_close_price,
            volume: (int) $goldPrice->volume,
        );
    }
}