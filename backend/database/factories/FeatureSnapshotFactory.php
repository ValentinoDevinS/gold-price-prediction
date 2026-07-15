<?php

namespace Database\Factories;

use App\Models\SentimentAnalysis;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeatureSnapshotFactory extends Factory
{
    public function definition(): array
    {
        return [

            'sentiment_analysis_id' => SentimentAnalysis::factory(),

            'positive_score' => fake()->randomFloat(6,0,1),

            'neutral_score' => fake()->randomFloat(6,0,1),

            'negative_score' => fake()->randomFloat(6,0,1),

            'word_count' => fake()->numberBetween(300,2500),

            'article_count' => fake()->numberBetween(1,100),

            'average_sentiment' => fake()->randomFloat(6,0,1),

            'rolling_sentiment_3d' => fake()->randomFloat(6,0,1),

            'rolling_sentiment_7d' => fake()->randomFloat(6,0,1),

            'rolling_sentiment_14d' => fake()->randomFloat(6,0,1),

            'weekday' => fake()->numberBetween(1,7),

            'month' => fake()->numberBetween(1,12),

            'quarter' => fake()->numberBetween(1,4),

            'is_weekend' => fake()->boolean(),

            'gold_price' => fake()->randomFloat(2,1800,3500),

            'gold_change_percent' => fake()->randomFloat(4,-5,5),

            'usd_index' => fake()->randomFloat(4,90,120),

            'etf_flow' => fake()->randomFloat(2,-100000,100000),

            'trading_volume' => fake()->randomFloat(2,1000000,100000000),

            'feature_version' => '1.0',

            'snapshot_date' => today(),

            'generated_at' => now(),

        ];
    }
}