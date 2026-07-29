<?php

declare(strict_types=1);

namespace App\DTOs\CleanArticle;

use App\Models\CleanArticle;
use Carbon\Carbon;

final readonly class CleanArticleData
{
    public function __construct(
        public string $uuid,

        public ?string $articleTitle,

        public ?string $articleSource,

        public ?string $language,

        public ?string $originalContent,

        public string $cleanContent,

        public int $originalWordCount,

        public int $cleanWordCount,

        public string $cleanerVersion,

        public ?Carbon $cleanedAt,
    ) {
    }

    /**
     * Create DTO from model.
     */
    public static function fromModel(
        CleanArticle $cleanArticle,
    ): self {

        return new self(

            uuid: $cleanArticle->uuid,

            articleTitle: $cleanArticle
                ->fullArticle?->article?->title,

            articleSource: $cleanArticle
                ->fullArticle?->article?->source,

            language: $cleanArticle
                ->fullArticle?->article?->language,

            originalContent: $cleanArticle
                ->fullArticle?->content,

            cleanContent: $cleanArticle->clean_content,

            originalWordCount: $cleanArticle->original_word_count,

            cleanWordCount: $cleanArticle->clean_word_count,

            cleanerVersion: $cleanArticle->cleaner_version,

            cleanedAt: $cleanArticle->cleaned_at,
        );
    }
}