<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\FullArticle;
use Illuminate\Database\Seeder;

class FullArticleSeeder extends Seeder
{
    public function run(): void
    {
        Article::all()->each(function ($article) {

            FullArticle::create([

                'article_id' => $article->id,

                'content' => fake()->paragraphs(30, true),

                'html' => '<html><body>Example HTML</body></html>',

                'author' => fake()->name(),

                'image_url' => fake()->imageUrl(),

                'word_count' => fake()->numberBetween(
                    500,
                    3000
                ),

                'download_status' => 'completed',

                'downloaded_at' => now(),

            ]);

        });
    }
}