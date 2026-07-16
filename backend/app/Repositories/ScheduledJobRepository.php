<?php

namespace App\Repositories;

use App\Models\ScheduledJob;
use Illuminate\Database\Eloquent\Collection;

class ScheduledJobRepository extends BaseRepository
{
    protected function model(): string
    {
        return ScheduledJob::class;
    }

    protected array $searchable = [

        'job_key',

        'job_name',

        'job_group',

    ];

    protected array $filterable = [

        'job_group',

        'schedule_type',

        'state',

        'is_enabled',

    ];

    protected array $sortable = [

        'display_order',

        'job_name',

        'last_run_at',

        'next_run_at',

    ];

    /**
     * All jobs ordered for display.
     */
    public function allOrdered(): Collection
    {
        return

            $this->model

                ->orderBy(
                    'job_group'
                )

                ->orderBy(
                    'display_order'
                )

                ->get();

    }

    /**
     * Enabled jobs.
     */
    public function enabled(): Collection
    {
        return

            $this->model

                ->where(
                    'is_enabled',
                    true
                )

                ->orderBy(
                    'display_order'
                )

                ->get();

    }

    /**
     * Disabled jobs.
     */
    public function disabled(): Collection
    {
        return

            $this->model

                ->where(
                    'is_enabled',
                    false
                )

                ->orderBy(
                    'display_order'
                )

                ->get();

    }

    /**
     * Running jobs.
     */
    public function running(): Collection
    {
        return

            $this->model

                ->where(
                    'state',
                    'RUNNING'
                )

                ->get();

    }

    /**
     * Queued jobs.
     */
    public function queued(): Collection
    {
        return

            $this->model

                ->where(
                    'state',
                    'QUEUED'
                )

                ->get();

    }

    /**
     * Failed jobs.
     */
    public function failed(): Collection
    {
        return

            $this->model

                ->where(
                    'state',
                    'FAILED'
                )

                ->get();

    }

    /**
     * Find by job key.
     */
    public function findByJobKey(
        string $jobKey
    ): ?ScheduledJob
    {
        return

            $this->model

                ->where(
                    'job_key',
                    $jobKey
                )

                ->first();

    }

    /**
     * Update one scheduled job.
     */
    public function updateJob(
        ScheduledJob $job,
        array $attributes
    ): bool
    {
        return

            $job->update(

                $attributes

            );

    }
}