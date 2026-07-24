<?php

namespace App\Services;

use App\Models\JobExecution;
use App\Repositories\JobExecutionRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class JobExecutionService
{
    public function __construct(

        private readonly JobExecutionRepository $repository,

    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | Record Execution
    |--------------------------------------------------------------------------
    */

    /**
     * Record one execution.
     */
    public function record(
        array $data
    ): JobExecution
    {
        return

            $this->repository

                ->create(

                    $data

                );

    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    /**
     * Dashboard data.
     */
    public function dashboard(): array
    {
        return [

            'latest'

                =>

                $this->repository

                    ->latest(),

            'statistics'

                =>

                $this->repository

                    ->statistics(),

            'generated_at'

                =>

                now(),

        ];

    }

    /*
    |--------------------------------------------------------------------------
    | Execution History
    |--------------------------------------------------------------------------
    */

    /**
     * Paginated execution history.
     */
    public function history(
        int $perPage = 25
    ): LengthAwarePaginator
    {
        return

            $this->repository

                ->history(

                    $perPage

                );

    }

    /**
     * History for one scheduled job.
     */
    public function historyByJob(
        int $scheduledJobId,
        int $perPage = 25
    ): LengthAwarePaginator
    {
        return

            $this->repository

                ->byJob(

                    $scheduledJobId,

                    $perPage

                );

    }

    /*
    |--------------------------------------------------------------------------
    | Statistics
    |--------------------------------------------------------------------------
    */

    /**
     * Execution statistics.
     */
    public function statistics(): array
    {
        return

            $this->repository

                ->statistics();

    }

    /*
    |--------------------------------------------------------------------------
    | Maintenance
    |--------------------------------------------------------------------------
    */

    /**
     * Delete old execution records.
     */
    public function clearOldExecutions(
        int $days = 30
    ): int
    {
        return

            $this->repository

                ->query()

                ->where(

                    'started_at',

                    '<',

                    now()->subDays(

                        $days

                    )

                )

                ->delete();

    }

    /**
     * Cleanup execution history.
     */
    public function cleanup(): array
    {
        $deleted =

            $this->clearOldExecutions();

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