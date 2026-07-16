<?php

namespace App\Services\HealthChecks;

use Illuminate\Support\Facades\DB;

class DatabaseHealthCheck
{
    /**
     * Check database connectivity.
     */
    public function check(): array
    {
        $start = microtime(true);

        try {

            DB::select('SELECT 1');

            return [

                'status' => 'HEALTHY',

                'message' => 'Database connection successful.',

                'duration_ms' => $this->duration($start),

            ];

        } catch (\Throwable $exception) {

            return [

                'status' => 'CRITICAL',

                'message' => $exception->getMessage(),

                'duration_ms' => $this->duration($start),

            ];

        }
    }

    /**
     * Execution time.
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