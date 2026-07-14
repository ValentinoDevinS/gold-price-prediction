<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating an article.
     */
    public function test_can_create_article(): void
    {
        $payload = [

            'title' => 'Gold price rises',

            'url' => 'https://example.com/news/1',

            'source' => 'Reuters',

            'published_at' => now(),

            'language' => 'en',

            'country' => 'US',

            'keyword' => 'gold',

            'scraper' => 'Google News',

            'scraped_at' => now(),

        ];

        $response = $this->postJson(
            '/api/v1/ai/articles',
            $payload
        );

        $response

            ->assertCreated()

            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseHas(
            'articles',
            [
                'title' => 'Gold price rises',
            ]
        );
    }

    public function test_can_get_article(): void
    {
        $article = Article::factory()->create();

        $response = $this->getJson(
            "/api/v1/ai/articles/{$article->uuid}"
        );

        $response
            ->assertOk()
            ->assertJson([
                'success' => true,
            ])
            ->assertJsonPath(
                'data.uuid',
                $article->uuid
            );
    }

    public function test_can_list_articles(): void
    {
        Article::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(
            '/api/v1/ai/articles'
        );

        $response
            ->assertOk()
            ->assertJson([
                'success' => true,
            ]);

        $this->assertCount(
            5,
            $response->json('data.data')
        );
    }
}