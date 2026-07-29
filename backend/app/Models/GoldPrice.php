<?php

declare(strict_types=1);

namespace App\Models;

final class GoldPrice extends BaseModel
{
    protected function casts(): array
    {
        return array_merge(parent::casts(), [

            'price_date' => 'date',

            'open_price' => 'decimal:4',
            'high_price' => 'decimal:4',
            'low_price' => 'decimal:4',
            'close_price' => 'decimal:4',
            'adjusted_close_price' => 'decimal:4',

            'volume' => 'integer',

        ]);
    }
}