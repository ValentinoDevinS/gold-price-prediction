<?php

namespace App\Services\HealthChecks;

use App\Services\PythonProcessService;

class PythonHealthCheck
{
    public function __construct(
        private readonly PythonProcessService $python,
    ) {
    }

    /**
     * Check Python environment.
     */
    public function check(): array
    {
        $start = microtime(true);

        if (! $this->python->isPythonInstalled()) {

            return [

                'status' => 'CRITICAL',

                'message' => 'Python executable not found.',

                'duration_ms' => $this->duration($start),

            ];

        }

        return [

            'status' => 'HEALTHY',

            'message' => $this->python->pythonVersion(),

            'duration_ms' => $this->duration($start),

        ];
    }

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