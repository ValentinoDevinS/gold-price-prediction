<?php

declare(strict_types=1);

namespace App\DTOs\Article;

use App\Enums\ArticleStatus;
use App\Models\Article;
use Carbon\Carbon;

final readonly class ArticleData
{
    public function __construct(
        public string $uuid,
        public string $title,
        public string $url,
        public string $source,
        public ?Carbon $publishedAt,
        public ?string $language,
        public ?string $country,
        public ?string $keyword,
        public ?string $scraper,
        public ArticleStatus $status,
        public ?Carbon $scrapedAt,
    ) {
    }

    /**
     * Create DTO from model.
     */
    public static function fromModel(
        Article $article,
    ): self {

        return new self(
            uuid: $article->uuid,
            title: $article->title,
            url: $article->url,
            source: $article->source,
            publishedAt: $article->published_at,
            language: $article->language,
            country: $article->country,
            keyword: $article->keyword,
            scraper: $article->scraper,
            status: $article->status,
            scrapedAt: $article->scraped_at,
        );
    }

    /**
     * Convert a collection of models into DTOs.
     *
     * @param iterable<Article> $articles
     * @return array<int, self>
     */
    public static function collection(
        iterable $articles,
    ): array {

        return collect($articles)
            ->map(
                static fn (Article $article): self => self::fromModel($article)
            )
            ->values()
            ->all();
    }
}