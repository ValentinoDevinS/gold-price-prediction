<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\GoldPrice;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class GoldPriceRepository extends BaseRepository
{
    protected string $defaultSort = 'price_date';

    protected array $sortable = [
        'price_date',
        'open_price',
        'high_price',
        'low_price',
        'close_price',
        'volume',
    ];

    protected array $searchable = [
        'price_date',
    ];

    public function __construct(
        GoldPrice $model,
    ) {
        parent::__construct($model);
    }

    /**
     * Find a gold price by trading date.
     */
    public function findByDate(
        Carbon|string $date,
    ): ?GoldPrice {
        return $this->query()
            ->whereDate('price_date', $date)
            ->first();
    }

    /**
     * Get prices between two dates.
     */
    public function betweenDates(
        Carbon|string $start,
        Carbon|string $end,
    ): Collection {
        return $this->query()
            ->whereBetween('price_date', [$start, $end])
            ->orderBy('price_date')
            ->get();
    }

    /**
     * Get latest trading date.
     */
    public function latestDate(): ?Carbon
    {
        return $this->query()
            ->latest('price_date')
            ->first()?->price_date;
    }

    /**
     * Check whether a trading date exists.
     */
    public function existsByDate(
        Carbon|string $date,
    ): bool {
        return $this->query()
            ->whereDate('price_date', $date)
            ->exists();
    }

    public function latestOne(): ?Model
    {
        return $this->query()
            ->latest($this->defaultSort)
            ->first();
    }
}