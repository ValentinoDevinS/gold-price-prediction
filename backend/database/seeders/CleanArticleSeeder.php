<?php

namespace Database\Seeders;

use App\Models\CleanArticle;
use App\Models\FullArticle;
use Illuminate\Database\Seeder;

class CleanArticleSeeder extends Seeder
{
    public function run(): void
    {
        FullArticle::all()->each(function ($fullArticle) {

            CleanArticle::create([

                'full_article_id' => $fullArticle->id,

                'clean_content' => fake()->paragraphs(
                    15,
                    true
                ),

                'original_word_count' => fake()->numberBetween(
                    600,
                    3000
                ),

                'clean_word_count' => fake()->numberBetween(
                    400,
                    2500
                ),

                'cleaner_version' => '1.0',

                'cleaned_at' => now(),

            ]);

        });
    }
}
