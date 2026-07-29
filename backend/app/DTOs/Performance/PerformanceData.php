<?php

declare(strict_types=1);

namespace App\DTOs\Performance;

use App\Models\PredictionEvaluation;
use Carbon\Carbon;

final readonly class PerformanceData
{
    public function __construct(

        /*
        |--------------------------------------------------------------------------
        | Identity
        |--------------------------------------------------------------------------
        */

        public string $uuid,

        /*
        |--------------------------------------------------------------------------
        | Article
        |--------------------------------------------------------------------------
        */

        public ?string $articleTitle,

        public ?string $articleSource,

        public ?string $language,

        /*
        |--------------------------------------------------------------------------
        | Prediction
        |--------------------------------------------------------------------------
        */

        public ?string $modelName,

        public ?string $modelVersion,

        public ?float $predictedPrice,

        public ?float $confidenceScore,

        /*
        |--------------------------------------------------------------------------
        | Actual
        |--------------------------------------------------------------------------
        */

        public float $actualPrice,

        /*
        |--------------------------------------------------------------------------
        | Error Metrics
        |--------------------------------------------------------------------------
        */

        public float $absoluteError,

        public float $squaredError,

        public float $percentageError,

        /*
        |--------------------------------------------------------------------------
        | Dates
        |--------------------------------------------------------------------------
        */

        public ?Carbon $predictionDate,

        public ?Carbon $actualPriceDate,

        public ?Carbon $evaluatedAt,

        /*
        |--------------------------------------------------------------------------
        | Computed
        |--------------------------------------------------------------------------
        */

        public string $modelLabel,

        public string $displayPredictionDate,

        public string $displayActualDate,

        public string $displayEvaluatedAt,

        public string $displayConfidence,

        public string $performanceGrade,

        public bool $isExcellent,

        public bool $isGood,

        public bool $isPoor,

    ) {
    }

    public static function fromModel(
        PredictionEvaluation $evaluation,
    ): self {

        $prediction = $evaluation->predictionResult;

        $article = $prediction?->featureSnapshot
            ?->sentimentAnalysis
            ?->cleanArticle
            ?->fullArticle
            ?->article;

        $percentageError = (float) $evaluation->percentage_error;

        return new self(

            uuid: $evaluation->uuid,

            articleTitle: $article?->title,

            articleSource: $article?->source,

            language: $article?->language,

            modelName: $prediction?->model_name,

            modelVersion: $prediction?->model_version,

            predictedPrice: $prediction?->predicted_price,

            confidenceScore: $prediction?->confidence_score,

            actualPrice: (float) $evaluation->actual_price,

            absoluteError: (float) $evaluation->absolute_error,

            squaredError: (float) $evaluation->squared_error,

            percentageError: $percentageError,

            predictionDate: $prediction?->prediction_date,

            actualPriceDate: $evaluation->actual_price_date,

            evaluatedAt: $evaluation->evaluated_at,

            modelLabel: trim(
                ($prediction?->model_name ?? '-')
                .' '.
                ($prediction?->model_version ?? '')
            ),

            displayPredictionDate:
                $prediction?->prediction_date?->format('d M Y') ?? '-',

            displayActualDate:
                $evaluation->actual_price_date?->format('d M Y') ?? '-',

            displayEvaluatedAt:
                $evaluation->evaluated_at?->format('d M Y H:i') ?? '-',

            displayConfidence:
                $prediction?->confidence_score !== null
                    ? number_format(
                        (float) $prediction->confidence_score * 100,
                        2
                    ).'%'
                    : '-',

            performanceGrade:
                match (true) {

                    $percentageError <= 1 => 'Excellent',

                    $percentageError <= 3 => 'Good',

                    $percentageError <= 5 => 'Fair',

                    default => 'Poor',

                },

            isExcellent: $percentageError <= 1,

            isGood: $percentageError > 1
                && $percentageError <= 3,

            isPoor: $percentageError > 5,

        );
    }
}