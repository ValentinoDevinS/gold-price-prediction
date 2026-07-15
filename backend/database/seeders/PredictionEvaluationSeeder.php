<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PredictionEvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (PredictionResult::all() as $prediction) {

            $service->evaluatePredictionResult(
                $prediction->uuid,
                [
                    'actual_price' => fake(),
                    'actual_price_date' => $prediction->prediction_date,
                ]
            );

        }

        foreach (EnsembleResult::all() as $ensemble) {

            $service->evaluateEnsembleResult(
                $ensemble->uuid,
                [
                    'actual_price' => fake(),
                    'actual_price_date' => $ensemble->prediction_date,
                ]
            );

        }
    }
}
