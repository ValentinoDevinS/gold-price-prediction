<?php

declare(strict_types=1);

namespace App\DTOs\FullArticle;

use App\DTOs\Article\ArticleData;
use App\Models\FullArticle;
use Carbon\Carbon;

final readonly class FullArticleData
{
    public function __construct(
        public string $uuid,
        public ArticleData $article,
        public string $content,
        public ?string $html,
        public ?string $author,
        public ?string $imageUrl,
        public int $wordCount,
        public string $downloadStatus,
        public ?Carbon $downloadedAt,
        public Carbon $createdAt,
        public Carbon $updatedAt,
    ) {
    }

    public static function fromModel(
        FullArticle $fullArticle,
    ): self {

        return new self(
            uuid: $fullArticle->uuid,
            article: ArticleData::fromModel($fullArticle->article),
            content: $fullArticle->content,
            html: $fullArticle->html,
            author: $fullArticle->author,
            imageUrl: $fullArticle->image_url,
            wordCount: $fullArticle->word_count,
            downloadStatus: $fullArticle->download_status,
            downloadedAt: $fullArticle->downloaded_at,
            createdAt: $fullArticle->created_at,
            updatedAt: $fullArticle->updated_at,
        );

    }

    /**
     * Convert multiple models into DTOs.
     *
     * @param iterable<FullArticle> $models
     * @return array<int, self>
     */
    public static function collection(
        iterable $models,
    ): array {

        $items = [];

        foreach ($models as $model) {
            $items[] = self::fromModel($model);
        }

        return $items;

    }
}