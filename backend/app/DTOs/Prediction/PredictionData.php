<?php

declare(strict_types=1);

namespace App\DTOs\Prediction;

use App\Models\PredictionResult;
use Carbon\Carbon;

final readonly class PredictionData
{
    public function __construct(

        // Identity
        public string $uuid,

        // Article
        public ?string $articleTitle,
        public ?string $articleSource,
        public ?string $language,

        // Prediction
        public string $modelName,
        public string $modelVersion,
        public float $predictedPrice,
        public ?float $confidenceScore,

        // Evaluation
        public ?float $actualPrice,
        public ?float $absoluteError,
        public ?float $percentageError,
        public ?float $accuracy,

        // Dates
        public ?Carbon $predictionDate,
        public ?Carbon $predictedAt,

        // Computed
        public string $predictionStatus,
        public string $displayPredictionDate,
        public string $displayPredictedAt,
        public string $displayConfidence,
        public string $modelLabel,

    ) {
    }

    public static function fromModel(
        PredictionResult $prediction,
    ): self {

        $article = $prediction
            ->featureSnapshot?->sentimentAnalysis?->cleanArticle?->fullArticle?->article;

        $evaluation = $prediction->evaluation;

        return new self(

            uuid: $prediction->uuid,

            articleTitle: $article?->title,
            articleSource: $article?->source,
            language: $article?->language,

            modelName: $prediction->model_name,
            modelVersion: $prediction->model_version,

            predictedPrice: (float) $prediction->predicted_price,
            confidenceScore: $prediction->confidence_score !== null
                ? (float) $prediction->confidence_score
                : null,

            actualPrice: $evaluation?->actual_price,
            absoluteError: $evaluation?->absolute_error,
            percentageError: $evaluation?->percentage_error,
            accuracy: $evaluation?->accuracy,

            predictionDate: $prediction->prediction_date,
            predictedAt: $prediction->predicted_at,

            predictionStatus: $evaluation
                ? 'Evaluated'
                : 'Pending Evaluation',

            displayPredictionDate: $prediction->prediction_date?->format('d M Y') ?? '-',

            displayPredictedAt: $prediction->predicted_at?->format('d M Y H:i') ?? '-',

            displayConfidence: $prediction->confidence_score !== null
                ? number_format((float) $prediction->confidence_score * 100, 2).' %'
                : '-',

            modelLabel: sprintf(
                '%s %s',
                $prediction->model_name,
                $prediction->model_version,
            ),

        );
    }
}