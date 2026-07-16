<?php

namespace App\Services;

class HealthScoreCalculator
{
    /**
     * Calculate overall health score.
     */
    public function calculate(
        array $checks
    ): int {

        $score = 100;

        foreach (

            $checks

            as

            $check

        ) {

            switch (

                $check['status']

            ) {

                case 'WARNING':

                    $score -= 10;

                    break;

                case 'CRITICAL':

                    $score -= 30;

                    break;

                case 'OFFLINE':

                    $score -= 50;

                    break;

            }

        }

        return max(

            0,

            $score

        );

    }

    /**
     * Overall health status.
     */
    public function overallStatus(
        int $score
    ): string {

        return match (true) {

            $score >= 90

                => 'HEALTHY',

            $score >= 70

                => 'WARNING',

            $score >= 40

                => 'CRITICAL',

            default

                => 'OFFLINE',

        };

    }

    /**
     * System healthy?
     */
    public function isHealthy(
        int $score
    ): bool {

        return

            $score >= 90;

    }

}