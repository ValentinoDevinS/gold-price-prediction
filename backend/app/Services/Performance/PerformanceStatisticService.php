<?php

declare(strict_types=1);

namespace App\Services\Performance;

use App\Repositories\PredictionEvaluationRepository;

final readonly class PerformanceStatisticService
{
    public function __construct(
        private PredictionEvaluationRepository $repository,
    ) {
    }

    /**
     * Dashboard statistics.
     */
    public function getStatistics(): array
    {
        $bestModel = $this->repository
            ->bestPerformingModel();

        $worstModel = $this->repository
            ->worstPerformingModel();

        $mse = $this->repository
            ->averageSquaredError();

        return [

            /*
            |--------------------------------------------------------------------------
            | Overview
            |--------------------------------------------------------------------------
            */

            'total' =>

                $this->repository
                    ->countAll(),

            'today' =>

                $this->repository
                    ->countToday(),

            /*
            |--------------------------------------------------------------------------
            | Error Metrics
            |--------------------------------------------------------------------------
            */

            'mae' => round(

                $this->repository
                    ->averageAbsoluteError(),

                6,

            ),

            'mse' => round(
                $mse,
                6,
            ),

            'rmse' => round(
                sqrt($mse),
                6,
            ),

            'mape' => round(

                $this->repository
                    ->averagePercentageError(),

                4,

            ),

            /*
            |--------------------------------------------------------------------------
            | Ranking
            |--------------------------------------------------------------------------
            */

            'best_model' =>

                $bestModel?->model_name,

            'best_model_error' =>

                $bestModel?->avg_error,

            'worst_model' =>

                $worstModel?->model_name,

            'worst_model_error' =>

                $worstModel?->avg_error,

        ];
    }
}