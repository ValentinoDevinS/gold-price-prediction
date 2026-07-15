<?php

namespace Database\Seeders;

use App\Enums\SentimentLabel;
use App\Models\CleanArticle;
use App\Models\SentimentAnalysis;
use Illuminate\Database\Seeder;

class SentimentAnalysisSeeder extends Seeder
{
    public function run(): void
    {
        CleanArticle::all()->each(function ($cleanArticle) {

            $positive = fake()->randomFloat(
                6,
                0,
                1
            );

            $neutral = fake()->randomFloat(
                6,
                0,
                1 - $positive
            );

            $negative = max(
                0,
                1 - $positive - $neutral
            );

            $label = SentimentLabel::Neutral;

            if ($positive >= $neutral && $positive >= $negative) {
                $label = SentimentLabel::Positive;
            }

            if ($negative >= $positive && $negative >= $neutral) {
                $label = SentimentLabel::Negative;
            }

            SentimentAnalysis::create([

                'clean_article_id' => $cleanArticle->id,

                'positive_score' => $positive,

                'neutral_score' => $neutral,

                'negative_score' => $negative,

                'sentiment_label' => $label,

                'model_name' => 'ProsusAI/finbert',

                'model_version' => '1.0',

                'analyzed_at' => now(),

            ]);

        });
    }
}