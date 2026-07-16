<?php

namespace App\Services;

use App\Models\SystemActivity;
use App\Repositories\SystemActivityRepository;

class SystemActivityService
{
    public function __construct(

        private readonly SystemActivityRepository $repository,

    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | Record Activity
    |--------------------------------------------------------------------------
    */

    /**
     * Record one system activity.
     */
    public function record(
        string $module,
        string $event,
        string $message,
        string $status = 'INFO'
    ): SystemActivity
    {
        return

            $this->repository

                ->record([

                    'module'

                        =>

                        $module,

                    'event'

                        =>

                        $event,

                    'message'

                        =>

                        $message,

                    'status'

                        =>

                        $status,

                    'occurred_at'

                        =>

                        now(),

                ]);

    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    /**
     * Dashboard activities.
     */
    public function dashboard(): array
    {
        return [

            'activities'

                =>

                $this->history(

                    10

                ),

            'generated_at'

                =>

                now(),

        ];

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
    )
    {
        return

            $this->repository

                ->history(

                    $perPage

                );

    }

    /*
    |--------------------------------------------------------------------------
    | Maintenance
    |--------------------------------------------------------------------------
    */

    /**
     * Delete old activities.
     */
    public function clearOldActivities(
        int $days = 30
    ): int
    {
        return

            $this->repository

                ->query()

                ->where(

                    'occurred_at',

                    '<',

                    now()->subDays(

                        $days

                    )

                )

                ->delete();

    }

    /**
     * Archive historical activities.
     *
     * Reserved for future implementation.
     */
    public function archive(): bool
    {
        /*
        |--------------------------------------------------------------------------
        | Future Feature
        |--------------------------------------------------------------------------
        |
        | Archive old activities into another storage
        | if required in future versions.
        |
        */

        return true;
    }

    /**
     * Execute activity maintenance.
     */
    public function cleanup(): array
    {
        $deleted =

            $this->clearOldActivities();

        return [

            'deleted'

                =>

                $deleted,

            'completed_at'

                =>

                now(),

        ];

    }
}