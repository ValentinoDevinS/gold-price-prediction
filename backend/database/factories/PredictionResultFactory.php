<?php

namespace Database\Factories;

use App\Models\FeatureSnapshot;
use App\Models\PredictionResult;
use Illuminate\Database\Eloquent\Factories\Factory;

class PredictionResultFactory extends Factory
{
    protected $model = PredictionResult::class;

    public function definition(): array
    {
        return [

            'feature_snapshot_id'
                => FeatureSnapshot::factory(),

            'model_name'
                => fake()->randomElement(
                    PredictionResult::AVAILABLE_MODELS
                ),

            'model_version'
                => 'latest',

            'predicted_price'
                => fake()->randomFloat(2,1800,3500),

            'confidence_score'
                => fake()->randomFloat(6,0.5,1),

            'prediction_date'
                => today(),

            'predicted_at'
                => now(),

        ];
    }
}