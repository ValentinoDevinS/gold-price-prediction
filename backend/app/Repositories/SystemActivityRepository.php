<?php

namespace App\Repositories;

use App\Models\SystemActivity;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SystemActivityRepository extends BaseRepository
{
    /**
     * Model class.
     */
    protected function model(): string
    {
        return SystemActivity::class;
    }

    /*
    |--------------------------------------------------------------------------
    | Search Configuration
    |--------------------------------------------------------------------------
    */

    protected array $searchable = [

        'module',

        'event',

        'message',

        'status',

    ];

    protected array $filterable = [

        'module',

        'event',

        'status',

    ];

    protected array $sortable = [

        'occurred_at',

        'created_at',

    ];

    /*
    |--------------------------------------------------------------------------
    | Query Builder
    |--------------------------------------------------------------------------
    */

    /**
     * Get a new query builder.
     */
    public function query(): Builder
    {
        return

            $this->model

                ->newQuery();

    }

    /*
    |--------------------------------------------------------------------------
    | Record Activity
    |--------------------------------------------------------------------------
    */

    /**
     * Store one activity.
     */
    public function record(
        array $data
    ): SystemActivity
    {
        return

            $this->create(

                $data

            );

    }

    /*
    |--------------------------------------------------------------------------
    | Activity History
    |--------------------------------------------------------------------------
    */

    /**
     * Paginated activity history.
     */
    public function history(
        int $perPage = 25
    ): LengthAwarePaginator
    {
        return

            $this->query()

                ->orderByDesc(

                    'occurred_at'

                )

                ->paginate(

                    $perPage

                );

    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    /**
     * Latest activities.
     */
    public function latest(
        int $limit = 10
    ): Collection
    {
        return

            $this->query()

                ->orderByDesc(

                    'occurred_at'

                )

                ->limit(

                    $limit

                )

                ->get();

    }

    /*
    |--------------------------------------------------------------------------
    | Maintenance
    |--------------------------------------------------------------------------
    */

    /**
     * Delete activities older than the given number of days.
     */
    public function clearOlderThan(
        int $days
    ): int
    {
        return

            $this->query()

                ->where(

                    'occurred_at',

                    '<',

                    now()->subDays(

                        $days

                    )

                )

                ->delete();

    }
}