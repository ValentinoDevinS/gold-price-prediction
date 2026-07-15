<?php

namespace Database\Seeders;

use App\Models\FeatureSnapshot;
use App\Models\PredictionResult;
use Illuminate\Database\Seeder;

class PredictionResultSeeder extends Seeder
{
    public function run(): void
    {
        FeatureSnapshot::all()->each(function ($feature) {

            foreach ([
                PredictionResult::MODEL_LSTM,
                PredictionResult::MODEL_CNN,
                PredictionResult::MODEL_ANN,
            ] as $model) {

                PredictionResult::create([

                    'feature_snapshot_id'
                        => $feature->id,

                    'model_name'
                        => $model,

                    'model_version'
                        => 'latest',

                    'predicted_price'
                        => fake()->randomFloat(2,1800,3500),

                    'confidence_score'
                        => fake()->randomFloat(6,0.6,1),

                    'prediction_date'
                        => today(),

                    'predicted_at'
                        => now(),

                ]);

            }

        });
    }
}