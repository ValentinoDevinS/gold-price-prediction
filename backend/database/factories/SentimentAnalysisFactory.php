<?php

namespace Database\Factories;

use App\Enums\SentimentLabel;
use App\Models\CleanArticle;
use Illuminate\Database\Eloquent\Factories\Factory;

class SentimentAnalysisFactory extends Factory
{
    public function definition(): array
    {
        return [

            'clean_article_id' => CleanArticle::factory(),

            'positive_score' => fake()->randomFloat(
                6,
                0,
                1
            ),

            'neutral_score' => fake()->randomFloat(
                6,
                0,
                1
            ),

            'negative_score' => fake()->randomFloat(
                6,
                0,
                1
            ),

            'sentiment_label' => fake()->randomElement(
                SentimentLabel::cases()
            ),

            'model_name' => 'ProsusAI/finbert',

            'model_version' => '1.0',

            'analyzed_at' => now(),

        ];
    }
}