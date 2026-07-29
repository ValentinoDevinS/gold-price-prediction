<?php

declare(strict_types=1);

namespace App\DTOs\SentimentAnalysis;

use App\Enums\SentimentLabel;
use App\Models\SentimentAnalysis;
use Carbon\Carbon;

final readonly class SentimentAnalysisData
{
    public function __construct(
        public string $uuid,

        // Article
        public ?string $articleTitle,
        public ?string $articleSource,
        public ?string $language,

        // Clean Article
        public ?string $cleanContent,

        // Scores
        public float $positiveScore,
        public float $neutralScore,
        public float $negativeScore,

        // Result
        public SentimentLabel $sentimentLabel,
        public string $label,
        public float $confidence,

        // Model
        public string $modelName,
        public string $modelVersion,

        // Metadata
        public ?Carbon $analyzedAt,
    ) {
    }

    /**
     * Create DTO from model.
     */
    public static function fromModel(
        SentimentAnalysis $sentiment,
    ): self {

        $positive = (float) $sentiment->positive_score;
        $neutral  = (float) $sentiment->neutral_score;
        $negative = (float) $sentiment->negative_score;

        return new self(

            uuid: $sentiment->uuid,

            articleTitle: $sentiment
                ->cleanArticle?->fullArticle?->article?->title,

            articleSource: $sentiment
                ->cleanArticle?->fullArticle?->article?->source,

            language: $sentiment
                ->cleanArticle?->fullArticle?->article?->language,

            cleanContent: $sentiment
                ->cleanArticle?->clean_content,

            positiveScore: $positive,

            neutralScore: $neutral,

            negativeScore: $negative,

            sentimentLabel: $sentiment->sentiment_label,

            label: $sentiment->sentiment_label->value,

            confidence: max(
                $positive,
                $neutral,
                $negative,
            ),

            modelName: $sentiment->model_name,

            modelVersion: $sentiment->model_version,

            analyzedAt: $sentiment->analyzed_at,
        );
    }
}