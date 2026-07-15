<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\FullArticle;
use Illuminate\Database\Eloquent\Factories\Factory;

class FullArticleFactory extends Factory
{
    protected $model = FullArticle::class;

    public function definition(): array
    {
        return [

            'article_id' => Article::factory(),

            'content' => fake()->paragraphs(
                30,
                true
            ),

            'html' => '<html></html>',

            'author' => fake()->name(),

            'image_url' => fake()->imageUrl(),

            'word_count' => fake()->numberBetween(
                500,
                3000
            ),

            'download_status' => 'completed',

            'downloaded_at' => now(),

        ];
    }
}