<?php

namespace Database\Seeders;

use App\Models\FeatureSnapshot;
use App\Models\SentimentAnalysis;
use Illuminate\Database\Seeder;

class FeatureSnapshotSeeder extends Seeder
{
    public function run(): void
    {
        SentimentAnalysis::all()->each(function ($sentiment) {

            FeatureSnapshot::create([

                'sentiment_analysis_id' => $sentiment->id,

                'positive_score' => $sentiment->positive_score,

                'neutral_score' => $sentiment->neutral_score,

                'negative_score' => $sentiment->negative_score,

                'word_count' => fake()->numberBetween(400,2000),

                'article_count' => fake()->numberBetween(1,50),

                'average_sentiment' => $sentiment->positive_score,

                'rolling_sentiment_3d' => fake()->randomFloat(6,0,1),

                'rolling_sentiment_7d' => fake()->randomFloat(6,0,1),

                'rolling_sentiment_14d' => fake()->randomFloat(6,0,1),

                'weekday' => now()->dayOfWeekIso,

                'month' => now()->month,

                'quarter' => now()->quarter,

                'is_weekend' => now()->isWeekend(),

                'gold_price' => fake()->randomFloat(2,1800,3500),

                'gold_change_percent' => fake()->randomFloat(4,-5,5),

                'usd_index' => null,

                'etf_flow' => null,

                'trading_volume' => null,

                'feature_version' => '1.0',

                'snapshot_date' => today(),

                'generated_at' => now(),

            ]);

        });
    }
}