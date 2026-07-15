<?php

namespace Database\Factories;

use App\Models\EnsembleResult;
use App\Models\FeatureSnapshot;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnsembleResultFactory extends Factory
{
    protected $model = EnsembleResult::class;

    public function definition(): array
    {
        return [

            'feature_snapshot_id'
                => FeatureSnapshot::factory(),

            'ensemble_method'
                => EnsembleResult::METHOD_AVERAGE,

            'model_version'
                => EnsembleResult::VERSION_LATEST,

            'predicted_price'
                => fake()->randomFloat(2,1800,3500),

            'confidence_score'
                => fake()->randomFloat(6,0.6,1),

            'prediction_date'
                => today(),

            'predicted_at'
                => now(),

        ];
    }
}