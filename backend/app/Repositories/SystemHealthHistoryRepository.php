<?php

namespace App\Repositories;

use App\Models\SystemHealthHistory;
use Illuminate\Database\Eloquent\Collection;

class SystemHealthHistoryRepository extends BaseRepository
{
    protected function model(): string
    {
        return SystemHealthHistory::class;
    }

    protected array $searchable = [

        'overall_status',

    ];

    protected array $filterable = [

        'overall_status',

        'is_healthy',

        'checked_at',

    ];

    protected array $sortable = [

        'checked_at',

        'health_score',

        'response_time_ms',

        'created_at',

    ];

    /**
     * Latest health check.
     */
    public function latest(): ?SystemHealthHistory
    {
        return

            $this->model

                ->latest(
                    'checked_at'
                )

                ->first();

    }

    /**
     * Health history.
     */
    public function history(): Collection
    {
        return

            $this->model

                ->orderByDesc(
                    'checked_at'
                )

                ->get();

    }

    /**
     * Recent history.
     */
    public function recent(
        int $limit = 30
    ): Collection {

        return

            $this->model

                ->latest(
                    'checked_at'
                )

                ->limit(
                    $limit
                )

                ->get();

    }

    /**
     * Latest unhealthy records.
     */
    public function unhealthy(
        int $limit = 20
    ): Collection {

        return

            $this->model

                ->where(
                    'is_healthy',
                    false
                )

                ->latest(
                    'checked_at'
                )

                ->limit(
                    $limit
                )

                ->get();

    }

    /**
     * Average health score.
     */
    public function averageHealthScore(): float
    {
        return

            round(

                (float)

                $this->model

                    ->avg(
                        'health_score'
                    ),

                2

            );

    }

    /**
     * Uptime percentage.
     */
    public function uptimePercentage(): float
    {
        $total =

            $this->model

                ->count();

        if (

            $total === 0

        ) {

            return 100.0;

        }

        $healthy =

            $this->model

                ->where(
                    'is_healthy',
                    true
                )

                ->count();

        return

            round(

                ($healthy / $total) * 100,

                2

            );

    }

    /**
     * Store one health check.
     */
    public function storeHealthCheck(
        array $payload
    ): SystemHealthHistory
    {
        return

            $this->create(

                $payload

            );

    }

    
}