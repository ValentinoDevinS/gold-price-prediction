<?php

namespace App\Services\HealthChecks;

use App\Services\PythonProcessService;

class PipelineHealthCheck
{
    public function __construct(
        private readonly PythonProcessService $python,
    ) {
    }

    /**
     * Check AI pipeline readiness.
     */
    public function check(): array
    {
        $start = microtime(true);

        $services = $this->python->scriptsPath();

        if (! is_dir($services)) {

            return [

                'status' => 'CRITICAL',

                'message' => 'Services directory not found.',

                'duration_ms' => $this->duration($start),

            ];

        }

        $required = [

            'scraper-service',

            'downloader-service',

            'cleaner-service',

            'finbert-service',

            'feature-service',

            'gold-price-service',

            'lstm-service',

            'cnn-service',

            'ann-service',

            'predict-service',

            'scheduler-service',

        ];

        $missing = [];

        foreach (

            $required

            as

            $folder

        ) {

            if (

                ! is_dir(

                    $services

                    .

                    DIRECTORY_SEPARATOR

                    .

                    $folder

                )

            ) {

                $missing[] = $folder;

            }

        }

        if (

            count($missing) > 0

        ) {

            return [

                'status' => 'WARNING',

                'message' =>

                    'Missing services: '

                    .

                    implode(

                        ', ',

                        $missing

                    ),

                'duration_ms' => $this->duration($start),

            ];

        }

        return [

            'status' => 'HEALTHY',

            'message' => 'All required services detected.',

            'duration_ms' => $this->duration($start),

        ];

    }

    /**
     * Execution duration.
     */
    private function duration(
        float $start
    ): int
    {
        return (int) round(

            (microtime(true) - $start)

            * 1000

        );
    }
}