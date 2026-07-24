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

        private readonly JobExecutionService $executions,

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
     * Execute one job manually.
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

                $job,

                true

            );

    }

    /*
    |--------------------------------------------------------------------------
    | Scheduled Execution
    |--------------------------------------------------------------------------
    */

    /**
     * Execute one scheduled job.
     */
    public function runScheduled(
        ScheduledJob $job
    ): array
    {
        return

            $this->execute(

                $job,

                false

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
        ScheduledJob $job,
        bool $manual = false
    ): array
    {
        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate Execution
        |--------------------------------------------------------------------------
        */

        if ($job->isRunning()) {

            return [

                'success' => false,

                'message' => 'Job is already running.',

            ];

        }

        $startedAt = now();

        $state = ScheduledJob::FAILED;

        $result = [];

        /*
        |--------------------------------------------------------------------------
        | Mark Running
        |--------------------------------------------------------------------------
        */

        $this->repository->updateJob(

            $job,

            [

                'state' => ScheduledJob::RUNNING,

            ]

        );

        $this->activity->record(

            'Scheduler',

            'Job Started',

            sprintf(

                '%s started (%s).',

                $job->job_name,

                $manual
                    ? 'Manual'
                    : 'Automatic'

            )

        );

        try {

            /*
            |--------------------------------------------------------------------------
            | Execute Python
            |--------------------------------------------------------------------------
            */

            $result =

                $this->python

                    ->runJob(

                        $job->job_key

                    );

            $state =

                $result['success']

                    ?

                    ScheduledJob::SUCCESS

                    :

                    ScheduledJob::FAILED;

        } catch (\Throwable $exception) {

            $result = [

                'success' => false,

                'status' => 'PHP_EXCEPTION',

                'exit_code' => null,

                'duration_ms' => now()->diffInMilliseconds(

                    $startedAt

                ),

                'stdout' => null,

                'stderr' => null,

                'message' => $exception->getMessage(),

            ];

            $state = ScheduledJob::FAILED;

        } finally {

            /*
            |--------------------------------------------------------------------------
            | Update Scheduled Job
            |--------------------------------------------------------------------------
            */

            $this->repository->updateJob(

                $job,

                [

                    'state'

                        =>

                        $state,

                    'last_run_at'

                        =>

                        now(),

                    'last_duration_ms'

                        =>

                        $result['duration_ms'] ?? null,

                    'last_exit_code'

                        =>

                        $result['exit_code'] ?? null,

                    'last_error_message'

                        =>

                        $result['message'] ?? null,

                ]

            );

            /*
            |--------------------------------------------------------------------------
            | Store Execution History
            |--------------------------------------------------------------------------
            */

            $this->executions->record([

                'scheduled_job_id'

                    =>

                    $job->id,

                'is_manual'

                    =>

                    $manual,

                'status'

                    =>

                    $state,

                'exit_code'

                    =>

                    $result['exit_code'] ?? null,

                'duration_ms'

                    =>

                    $result['duration_ms'] ?? 0,

                'stdout'

                    =>

                    $result['stdout'] ?? null,

                'stderr'

                    =>

                    $result['stderr'] ?? null,

                'error_message'

                    =>

                    $result['message'] ?? null,

                'started_at'

                    =>

                    $startedAt,

                'finished_at'

                    =>

                    now(),

            ]);

            /*
            |--------------------------------------------------------------------------
            | Activity
            |--------------------------------------------------------------------------
            */

            $this->activity->record(

                'Scheduler',

                'Job Finished',

                sprintf(

                    '%s finished (%s).',

                    $job->job_name,

                    $state

                )

            );

        }

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

                    'Configuration',

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

                    'Configuration',

                    "{$job->job_name} schedule updated."

                );

        }

        return $updated;

    }

    /*
    |--------------------------------------------------------------------------
    | Upcoming Jobs
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

        $status = 'HEALTHY';

        if (

            $summary['failed_jobs'] > 0

        ) {

            $status = 'WARNING';

        }

        if (

            $summary['enabled_jobs'] === 0

        ) {

            $status = 'CRITICAL';

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

            'summary'

                =>

                $summary,

            'generated_at'

                =>

                now(),

        ];

    }

}