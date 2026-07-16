<?php

namespace App\Services\HealthChecks;

class SchedulerHealthCheck
{
    /**
     * Check scheduler configuration.
     */
    public function check(): array
    {
        $start = microtime(true);

        $scheduleFile = base_path(
            'routes/console.php'
        );

        if (! file_exists($scheduleFile)) {

            return [

                'status' => 'CRITICAL',

                'message' => 'routes/console.php not found.',

                'duration_ms' => $this->duration($start),

            ];

        }

        return [

            'status' => 'HEALTHY',

            'message' => 'Scheduler configuration detected.',

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