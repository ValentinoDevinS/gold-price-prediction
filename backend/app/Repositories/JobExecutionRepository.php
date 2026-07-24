<?php

namespace App\Repositories;

use App\Models\JobExecution;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class JobExecutionRepository extends BaseRepository
{
    /**
     * Model class.
     */
    protected function model(): string
    {
        return JobExecution::class;
    }

    /*
    |--------------------------------------------------------------------------
    | Search Configuration
    |--------------------------------------------------------------------------
    */

    protected array $searchable = [

        'status',

        'error_message',

    ];

    protected array $filterable = [

        'scheduled_job_id',

        'status',

        'is_manual',

    ];

    protected array $sortable = [

        'started_at',

        'finished_at',

        'duration_ms',

        'created_at',

    ];

    /*
    |--------------------------------------------------------------------------
    | Query Builder
    |--------------------------------------------------------------------------
    */

    /**
     * Create a new query.
     */
    public function query(): Builder
    {
        return

            $this->model

                ->newQuery();

    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    /**
     * Latest executions.
     */
    public function latest(
        int $limit = 10
    ): Collection
    {
        return

            $this->query()

                ->with(

                    'scheduledJob'

                )

                ->latest(

                    'started_at'

                )

                ->limit(

                    $limit

                )

                ->get();

    }

    /*
    |--------------------------------------------------------------------------
    | History
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

            $this->query()

                ->with(

                    'scheduledJob'

                )

                ->latest(

                    'started_at'

                )

                ->paginate(

                    $perPage

                );

    }

    /*
    |--------------------------------------------------------------------------
    | Job History
    |--------------------------------------------------------------------------
    */

    /**
     * Execution history for one job.
     */
    public function byJob(
        int $scheduledJobId,
        int $perPage = 25
    ): LengthAwarePaginator
    {
        return

            $this->query()

                ->with(

                    'scheduledJob'

                )

                ->where(

                    'scheduled_job_id',

                    $scheduledJobId

                )

                ->latest(

                    'started_at'

                )

                ->paginate(

                    $perPage

                );

    }

    /*
    |--------------------------------------------------------------------------
    | Statistics
    |--------------------------------------------------------------------------
    */

    /**
     * Total executions.
     */
    public function total(): int
    {
        return

            $this->query()

                ->count();

    }

    /**
     * Successful executions.
     */
    public function successful(): int
    {
        return

            $this->query()

                ->where(

                    'status',

                    \App\Models\ScheduledJob::SUCCESS

                )

                ->count();

    }

    /**
     * Failed executions.
     */
    public function failed(): int
    {
        return

            $this->query()

                ->where(

                    'status',

                    \App\Models\ScheduledJob::FAILED

                )

                ->count();

    }

    /**
     * Manual executions.
     */
    public function manual(): int
    {
        return

            $this->query()

                ->where(

                    'is_manual',

                    true

                )

                ->count();

    }

    /**
     * Automatic executions.
     */
    public function automatic(): int
    {
        return

            $this->query()

                ->where(

                    'is_manual',

                    false

                )

                ->count();

    }

        /*
    |--------------------------------------------------------------------------
    | Dashboard Statistics
    |--------------------------------------------------------------------------
    */

    /**
     * Execution statistics.
     */
    public function statistics(): array
    {
        $query =

            $this->query();

        return [

            'total'

                =>

                (clone $query)

                    ->count(),

            'successful'

                =>

                (clone $query)

                    ->where(

                        'status',

                        \App\Models\ScheduledJob::SUCCESS

                    )

                    ->count(),

            'failed'

                =>

                (clone $query)

                    ->where(

                        'status',

                        \App\Models\ScheduledJob::FAILED

                    )

                    ->count(),

            'manual'

                =>

                (clone $query)

                    ->where(

                        'is_manual',

                        true

                    )

                    ->count(),

            'automatic'

                =>

                (clone $query)

                    ->where(

                        'is_manual',

                        false

                    )

                    ->count(),

        ];
    }

}