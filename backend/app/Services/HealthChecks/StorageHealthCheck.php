<?php

namespace App\Services\HealthChecks;

class StorageHealthCheck
{
    /**
     * Check storage accessibility.
     */
    public function check(): array
    {
        $start = microtime(true);

        $storage = config(
            'python.storage_path'
        );

        if (! is_dir($storage)) {

            return [

                'status' => 'CRITICAL',

                'message' => 'Storage directory not found.',

                'duration_ms' => $this->duration($start),

            ];

        }

        if (! is_writable($storage)) {

            return [

                'status' => 'WARNING',

                'message' => 'Storage directory is not writable.',

                'duration_ms' => $this->duration($start),

            ];

        }

        $free = disk_free_space($storage);

        $total = disk_total_space($storage);

        if (

            $free === false ||

            $total === false

        ) {

            return [

                'status' => 'WARNING',

                'message' => 'Unable to determine disk usage.',

                'duration_ms' => $this->duration($start),

            ];

        }

        $usage =

            (($total - $free) / $total)

            * 100;

        $status =

            match (true) {

                $usage >= 95

                    => 'CRITICAL',

                $usage >= 85

                    => 'WARNING',

                default

                    => 'HEALTHY',

            };

        return [

            'status' => $status,

            'message' => sprintf(

                'Disk usage %.2f%%',

                $usage

            ),

            'duration_ms' => $this->duration($start),

            'disk_usage_percent' => round(
                $usage,
                2
            ),

            'free_bytes' => $free,

            'total_bytes' => $total,

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