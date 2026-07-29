<?php

declare(strict_types=1);

namespace App\Http\Resources\GoldPrice;

use App\DTOs\GoldPrice\GoldPriceData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin GoldPriceData
 */
final class GoldPriceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        /** @var GoldPriceData $goldPrice */
        $goldPrice = $this->resource;

        return [
            'uuid' => $goldPrice->uuid,
            'price_date' => $goldPrice->priceDate,
            'open_price' => $goldPrice->openPrice,
            'high_price' => $goldPrice->highPrice,
            'low_price' => $goldPrice->lowPrice,
            'close_price' => $goldPrice->closePrice,
            'adjusted_close_price' => $goldPrice->adjustedClosePrice,
            'volume' => $goldPrice->volume,
        ];
    }
}