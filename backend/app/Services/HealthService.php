<?php

namespace App\Services;

use App\Repositories\SystemHealthHistoryRepository;
use App\Services\HealthChecks\DatabaseHealthCheck;
use App\Services\HealthChecks\PipelineHealthCheck;
use App\Services\HealthChecks\PythonHealthCheck;
use App\Services\HealthChecks\SchedulerHealthCheck;
use App\Services\HealthChecks\StorageHealthCheck;

class HealthService
{
    public function __construct(

        private readonly DatabaseHealthCheck $database,

        private readonly PythonHealthCheck $python,

        private readonly StorageHealthCheck $storage,

        private readonly SchedulerHealthCheck $scheduler,

        private readonly PipelineHealthCheck $pipeline,

        private readonly HealthScoreCalculator $calculator,

        private readonly SystemHealthHistoryRepository $repository,

    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | Execute Health Check
    |--------------------------------------------------------------------------
    */

    public function check(
        bool $persist = true
    ): array
    {
        $checks = [

            $this->database->check(),

            $this->python->check(),

            $this->storage->check(),

            $this->scheduler->check(),

            $this->pipeline->check(),

        ];

        $score =

            $this->calculator

                ->calculate(

                    $checks

                );

        $overall =

            $this->calculator

                ->overallStatus(

                    $score

                );

        $healthy =

            $this->calculator

                ->isHealthy(

                    $score

                );

        /*
        |--------------------------------------------------------------------------
        | Build Payload
        |--------------------------------------------------------------------------
        */

        $payload = [];

        foreach (

            $checks

            as

            $check

        ) {

            $payload[
                $check['component']
                .'_status'
            ] = $check['status'];

        }


        /*
        |--------------------------------------------------------------------------
        | Metadata
        |--------------------------------------------------------------------------
        */

        $payload['overall_status']

            =

            $overall;

        $payload['is_healthy']

            =

            $healthy;

        $payload['health_score']

            =

            $score;

        $payload['checked_at']

            =

            now();

        /*
        |--------------------------------------------------------------------------
        | Response Time
        |--------------------------------------------------------------------------
        */

        $payload['response_time_ms']

            =

            collect($checks)

                ->sum(

                    'duration_ms'

                );

        /*
        |--------------------------------------------------------------------------
        | Details
        |--------------------------------------------------------------------------
        */

        $payload['details']

            =

            collect($checks)

                ->mapWithKeys(

                    function (

                        array $check

                    ) {

                        return [

                            $check['component']

                                =>

                                [

                                    'status'

                                        =>

                                        $check['status'],

                                    'message'

                                        =>

                                        $check['message'],

                                    'duration_ms'

                                        =>

                                        $check['duration_ms'],

                                ],

                        ];

                    }

                )

                ->toArray();

        /*
        |--------------------------------------------------------------------------
        | Error Message
        |--------------------------------------------------------------------------
        */

        $errors =

            collect($checks)

                ->filter(

                    fn (

                        array $check

                    )

                        =>

                        $check['status']

                        !==

                        'HEALTHY'

                )

                ->pluck(

                    'message'

                )

                ->implode(

                    ' | '

                );

        $payload['error_message']

            =

            $errors

            ?: null;

                /*
        |--------------------------------------------------------------------------
        | Persist History
        |--------------------------------------------------------------------------
        */

        $history = null;

        if (

            $persist

        ) {

            $history =

                $this->repository

                    ->storeHealthCheck(

                        $payload

                    );

        }

        /*
        |--------------------------------------------------------------------------
        | Response
        |--------------------------------------------------------------------------
        */

        return [

            'overall_status'

                =>

                $overall,

            'is_healthy'

                =>

                $healthy,

            'health_score'

                =>

                $score,

            'response_time_ms'

                =>

                $payload['response_time_ms'],

            'checks'

                =>

                $checks,

            'history'

                =>

                $history,

        ];

    }

    /**
     * Latest stored health report.
     */
    public function latest()
    {
        return

            $this->repository

                ->latest();

    }

    /**
     * Health history.
     */
    public function history(
        int $limit = 30
    )
    {
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

}