<?php

namespace App\Services;

class SystemService
{
    public function __construct(

        private readonly HealthService $health,

        private readonly SelfTestService $selfTest,

        private readonly StorageService $storage,

        private readonly SchedulerService $scheduler,

        private readonly LogService $log,

    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    /**
     * System dashboard.
     */
    public function dashboard(): array
    {
        return [

            'health'

                =>

                $this->health
                    ->check(),

            'storage'

                =>

                $this->storage
                    ->summary(),

            'scheduler'

                =>

                $this->scheduler
                    ->summary(),

            'logs'

                =>

                $this->log
                    ->summary(),

            'generated_at'

                =>

                now(),

        ];

    }

    /*
    |--------------------------------------------------------------------------
    | Health
    |--------------------------------------------------------------------------
    */

    /**
     * Latest health report.
     */
    public function health()
    {
        return

            $this->health

                ->latest();

    }

    /**
     * Refresh health.
     */
    public function refresh()
    {
        return

            $this->health

                ->check();

    }

    /**
     * Health history.
     */
    public function healthHistory(
        int $limit = 30
    )
    {
        return

            $this->health

                ->history(

                    $limit

                );

    }

        /*
    |--------------------------------------------------------------------------
    | Self Test
    |--------------------------------------------------------------------------
    */

    /**
     * Execute a system self test.
     */
    public function selfTest(
        string $level = 'quick'
    ): array
    {
        return

            $this->selfTest

                ->run(

                    $level

                );

    }

    /*
    |--------------------------------------------------------------------------
    | Storage
    |--------------------------------------------------------------------------
    */

    /**
     * Storage summary.
     */
    public function storage(): array
    {
        return

            $this->storage

                ->summary();

    }

    /*
    |--------------------------------------------------------------------------
    | Scheduler
    |--------------------------------------------------------------------------
    */

    /**
     * Scheduler summary.
     */
    public function scheduler(): array
    {
        return

            $this->scheduler

                ->summary();

    }

    /*
    |--------------------------------------------------------------------------
    | Logs
    |--------------------------------------------------------------------------
    */

    /**
     * Log summary.
     */
    public function logs(): array
    {
        return

            $this->log

                ->summary();

    }

}