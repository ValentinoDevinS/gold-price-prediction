<?php

namespace Database\Factories;

use App\Enums\ArticleStatus;
use App\Helpers\HashHelper;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        $url = fake()->unique()->url();

        return [

            'title' => fake()->sentence(),

            'url' => $url,

            'url_hash' => HashHelper::generate($url),

            'source' => fake()->randomElement([
                'Reuters',
                'Bloomberg',
                'CNBC',
                'Kitco',
                'Yahoo Finance',
            ]),

            'published_at' => fake()->dateTimeBetween(
                '-30 days',
                'now'
            ),

            'language' => 'en',

            'country' => fake()->randomElement([
                'US',
                'UK',
                'JP',
                'AU',
            ]),

            'keyword' => fake()->randomElement([
                'gold',
                'gold price',
                'inflation',
                'bullion',
            ]),

            'scraper' => 'Google News',

            'status' => ArticleStatus::NEW,

            'scraped_at' => now(),

        ];
    }

    public function downloaded(): static
    {
        return $this->state(fn () => [
            'status' => ArticleStatus::DOWNLOADED,
        ]);
    }

    public function failed(): static
    {
        return $this->state(fn () => [
            'status' => ArticleStatus::FAILED,
        ]);
    }

    public function skipped(): static
    {
        return $this->state(fn () => [
            'status' => ArticleStatus::SKIPPED,
        ]);
    }
}