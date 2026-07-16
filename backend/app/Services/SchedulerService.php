<?php

namespace App\Services;

use App\Models\ScheduledJob;
use App\Repositories\ScheduledJobRepository;

class SchedulerService
{
    public function __construct(

        private readonly ScheduledJobRepository $repository,

        private readonly PythonProcessService $python,

        private readonly SystemActivityService $activity,

    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    /**
     * Scheduler dashboard.
     */
    public function dashboard(): array
    {
        return [

            'summary'

                =>

                $this->summary(),

            'jobs'

                =>

                $this->jobs(),

            'next_runs'

                =>

                $this->nextRuns(),

            'health'

                =>

                $this->health(),

            'generated_at'

                =>

                now(),

        ];

    }

    /*
    |--------------------------------------------------------------------------
    | Summary
    |--------------------------------------------------------------------------
    */

    /**
     * Scheduler summary.
     */
    public function summary(): array
    {
        return [

            'total_jobs'

                =>

                $this->repository
                    ->count(),

            'enabled_jobs'

                =>

                $this->repository
                    ->enabled()
                    ->count(),

            'disabled_jobs'

                =>

                $this->repository
                    ->disabled()
                    ->count(),

            'running_jobs'

                =>

                $this->repository
                    ->running()
                    ->count(),

            'queued_jobs'

                =>

                $this->repository
                    ->queued()
                    ->count(),

            'failed_jobs'

                =>

                $this->repository
                    ->failed()
                    ->count(),

        ];

    }

        /*
    |--------------------------------------------------------------------------
    | Jobs
    |--------------------------------------------------------------------------
    */

    /**
     * Scheduler jobs.
     */
    public function jobs()
    {
        return

            $this->repository

                ->allOrdered();

    }

    /*
    |--------------------------------------------------------------------------
    | Manual Execution
    |--------------------------------------------------------------------------
    */

    /**
     * Execute immediately.
     */
    public function runNow(
        string $jobKey
    ): array
    {
        $job =

            $this->repository

                ->findByJobKey(
                    $jobKey
                );

        if (! $job) {

            throw new \RuntimeException(
                'Job not found.'
            );

        }

        return

            $this->execute(
                $job
            );

    }

    /*
    |--------------------------------------------------------------------------
    | Scheduled Execution
    |--------------------------------------------------------------------------
    */

    /**
     * Execute from scheduler.
     */
    public function runScheduled(
        ScheduledJob $job
    ): array
    {
        return

            $this->execute(
                $job
            );

    }

        /*
    |--------------------------------------------------------------------------
    | Execute Job
    |--------------------------------------------------------------------------
    */

    /**
     * Execute one scheduled job.
     */
    private function execute(
        ScheduledJob $job
    ): array
    {
        /*
        |--------------------------------------------------------------------------
        | Prevent duplicate execution
        |--------------------------------------------------------------------------
        */

        if (

            $job->isRunning()

        ) {

            return [

                'success' => false,

                'message'

                    =>

                    'Job is already running.',

            ];

        }

        /*
        |--------------------------------------------------------------------------
        | Update State
        |--------------------------------------------------------------------------
        */

        $this->repository

            ->updateJob(

                $job,

                [

                    'state'

                        =>

                        ScheduledJob::RUNNING,

                ]

            );

        /*
        |--------------------------------------------------------------------------
        | Activity
        |--------------------------------------------------------------------------
        */

        $this->activity

            ->record(

                'Scheduler',

                "{$job->job_name} started."

            );

        /*
        |--------------------------------------------------------------------------
        | Python Execution
        |--------------------------------------------------------------------------
        */

        $result =

            $this->python

                ->runJob(

                    $job->job_key

                );

        /*
        |--------------------------------------------------------------------------
        | Final State
        |--------------------------------------------------------------------------
        */

        $state =

            $result['success']

                ?

                ScheduledJob::SUCCESS

                :

                'FAILED';

        $this->repository

            ->updateJob(

                $job,

                [

                    'state'

                        =>

                        $state,

                    'last_run_at'

                        =>

                        now(),

                ]

            );

        $this->activity

            ->record(

                'Scheduler',

                "{$job->job_name} finished ({$state})."

            );

        return $result;

    }

        /*
    |--------------------------------------------------------------------------
    | Job Configuration
    |--------------------------------------------------------------------------
    */

    
    /**
     * Enable or disable one scheduled job.
     */
    public function setEnabled(
        string $jobKey,
        bool $enabled
    ): bool
    {
        $job =

            $this->repository

                ->findByJobKey(
                    $jobKey
                );

        if (! $job) {

            return false;

        }

        $updated =

            $this->repository

                ->updateJob(

                    $job,

                    [

                        'is_enabled'

                            =>

                            $enabled,

                    ]

                );

        if ($updated) {

            $this->activity

                ->record(

                    'Scheduler',

                    sprintf(

                        '%s %s.',

                        $job->job_name,

                        $enabled
                            ? 'enabled'
                            : 'disabled'

                    )

                );

        }

        return $updated;

    }

    /**
     * Update scheduler configuration.
     */
    public function updateSchedule(
        string $jobKey,
        array $attributes
    ): bool
    {
        $job =

            $this->repository
                ->findByJobKey(
                    $jobKey
                );

        if (! $job) {

            return false;

        }

        $allowed = [

            'schedule_type',

            'interval_value',

            'cron_expression',

            'run_time',

        ];

        $data =

            array_intersect_key(

                $attributes,

                array_flip(
                    $allowed
                )

            );

        $updated =

            $this->repository
                ->updateJob(

                    $job,

                    $data

                );

        if ($updated) {

            $this->activity
                ->record(

                    'Scheduler',

                    "{$job->job_name} schedule updated."

                );

        }

        return $updated;

    }

        /*
    |--------------------------------------------------------------------------
    | Next Scheduled Runs
    |--------------------------------------------------------------------------
    */

    /**
     * Upcoming scheduled jobs.
     */
    public function nextRuns()
    {
        return

            $this->repository

                ->enabled()

                ->sortBy(

                    'next_run_at'

                )

                ->values();

    }

    /*
    |--------------------------------------------------------------------------
    | Scheduler Health
    |--------------------------------------------------------------------------
    */

    /**
     * Scheduler health.
     */
    public function health(): array
    {
        $summary =

            $this->summary();

        $status =

            'HEALTHY';

        if (

            $summary['failed_jobs'] > 0

        ) {

            $status =

                'WARNING';

        }

        if (

            $summary['enabled_jobs'] === 0

        ) {

            $status =

                'CRITICAL';

        }

        return [

            'status'

                =>

                $status,

            'message'

                =>

                match ($status) {

                    'HEALTHY'

                        =>

                        'Scheduler operating normally.',

                    'WARNING'

                        =>

                        'One or more scheduled jobs have failed.',

                    default

                        =>

                        'No scheduled jobs are enabled.',

                },

            'generated_at'

                =>

                now(),

        ];

    }

}