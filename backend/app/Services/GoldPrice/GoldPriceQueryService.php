<?php

declare(strict_types=1);

namespace App\Services\GoldPrice;

use App\DTOs\GoldPrice\GoldPriceData;
use App\Http\Requests\GoldPrice\GoldPriceIndexRequest;
use App\Repositories\GoldPriceRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final readonly class GoldPriceQueryService
{
    public function __construct(
        private GoldPriceRepository $repository,
    ) {
    }

    /**
     * Get the latest available gold price.
     */
    public function latest(): ?GoldPriceData
    {
        $goldPrice = $this->repository->latestOne();

        return $goldPrice !== null
            ? GoldPriceData::fromModel($goldPrice)
            : null;
    }

    /**
     * Get latest gold prices.
     */
    public function latestMany(int $limit = 30): Collection
    {
        return $this->repository
            ->latest($limit)
            ->map(fn ($model) => GoldPriceData::fromModel($model));
    }

    /**
     * Find price by date.
     */
    public function findByDate(Carbon|string $date): ?GoldPriceData
    {
        $goldPrice = $this->repository->findByDate($date);

        return $goldPrice
            ? GoldPriceData::fromModel($goldPrice)
            : null;
    }

    /**
     * Get prices between two dates.
     */
    public function betweenDates(
        Carbon|string $start,
        Carbon|string $end,
    ): Collection {
        return $this->repository
            ->betweenDates($start, $end)
            ->map(fn ($goldPrice) => GoldPriceData::fromModel($goldPrice));
    }

    /**
     * Get newest trading date.
     */
    public function latestDate(): ?Carbon
    {
        return $this->repository->latestDate();
    }

    /**
     * Check if data exists.
     */
    public function existsByDate(Carbon|string $date): bool
    {
        return $this->repository->existsByDate($date);
    }

    /**
     * Paginate gold prices.
     */
    public function paginate(
        GoldPriceIndexRequest $request,
    ): LengthAwarePaginator
    {
        $validated = $request->validated();

        $perPage = $validated['per_page'] ?? 25;

        $rows = $this->repository->getPaginated(
            search: $validated['search'] ?? null,
            sort: $validated['sort'] ?? null,
            direction: $validated['direction'] ?? null,
            filters: [],
            perPage: $perPage,
        );

        $rows->setCollection(
            $rows->getCollection()->map(
                fn ($model) => GoldPriceData::fromModel($model)
            )
        );

        return $rows;
    }
}