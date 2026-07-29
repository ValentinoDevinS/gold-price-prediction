<?php

declare(strict_types=1);

namespace App\DTOs\FeatureEngineering;

use App\Models\FeatureSnapshot;
use Carbon\Carbon;

final readonly class FeatureEngineeringData
{
    public function __construct(

        /*
        |--------------------------------------------------------------------------
        | Metadata
        |--------------------------------------------------------------------------
        */

        public string $uuid,

        public string $articleTitle,

        public string $articleSource,

        public string $language,

        /*
        |--------------------------------------------------------------------------
        | Sentiment Features
        |--------------------------------------------------------------------------
        */

        public float $positiveScore,

        public float $neutralScore,

        public float $negativeScore,

        public float $averageSentiment,

        /*
        |--------------------------------------------------------------------------
        | Article Features
        |--------------------------------------------------------------------------
        */

        public int $wordCount,

        public int $articleCount,

        /*
        |--------------------------------------------------------------------------
        | Rolling Features
        |--------------------------------------------------------------------------
        */

        public ?float $rollingSentiment3d,

        public ?float $rollingSentiment7d,

        public ?float $rollingSentiment14d,

        /*
        |--------------------------------------------------------------------------
        | Time Features
        |--------------------------------------------------------------------------
        */

        public int $weekday,

        public int $month,

        public int $quarter,

        public bool $isWeekend,

        /*
        |--------------------------------------------------------------------------
        | Market Features
        |--------------------------------------------------------------------------
        */

        public ?float $goldPrice,

        public ?float $goldChangePercent,

        public ?float $usdIndex,

        public ?float $etfFlow,

        public ?float $tradingVolume,

        /*
        |--------------------------------------------------------------------------
        | Metadata
        |--------------------------------------------------------------------------
        */

        public string $featureVersion,

        public ?Carbon $snapshotDate,

        public ?Carbon $generatedAt,

        /*
        |--------------------------------------------------------------------------
        | Computed
        |--------------------------------------------------------------------------
        */

        public string $weekdayName,

        public bool $readyForPrediction,

    ) {
    }

    public static function fromModel(
        FeatureSnapshot $feature,
    ): self {

        return new self(

            /*
            |--------------------------------------------------------------------------
            | Metadata
            |--------------------------------------------------------------------------
            */

            uuid: $feature->uuid,

            articleTitle:
                $feature->sentimentAnalysis
                    ->cleanArticle
                    ->fullArticle
                    ->article
                    ->title,

            articleSource:
                $feature->sentimentAnalysis
                    ->cleanArticle
                    ->fullArticle
                    ->article
                    ->source,

            language:
                $feature->sentimentAnalysis
                    ->cleanArticle
                    ->language,

            /*
            |--------------------------------------------------------------------------
            | Sentiment Features
            |--------------------------------------------------------------------------
            */

            positiveScore: (float) $feature->positive_score,

            neutralScore: (float) $feature->neutral_score,

            negativeScore: (float) $feature->negative_score,

            averageSentiment: (float) $feature->average_sentiment,

            /*
            |--------------------------------------------------------------------------
            | Article Features
            |--------------------------------------------------------------------------
            */

            wordCount: (int) $feature->word_count,

            articleCount: (int) $feature->article_count,

            /*
            |--------------------------------------------------------------------------
            | Rolling Features
            |--------------------------------------------------------------------------
            */

            rollingSentiment3d: $feature->rolling_sentiment_3d,

            rollingSentiment7d: $feature->rolling_sentiment_7d,

            rollingSentiment14d: $feature->rolling_sentiment_14d,

            /*
            |--------------------------------------------------------------------------
            | Time Features
            |--------------------------------------------------------------------------
            */

            weekday: (int) $feature->weekday,

            month: (int) $feature->month,

            quarter: (int) $feature->quarter,

            isWeekend: (bool) $feature->is_weekend,

            /*
            |--------------------------------------------------------------------------
            | Market Features
            |--------------------------------------------------------------------------
            */

            goldPrice: $feature->gold_price,

            goldChangePercent: $feature->gold_change_percent,

            usdIndex: $feature->usd_index,

            etfFlow: $feature->etf_flow,

            tradingVolume: $feature->trading_volume,

            /*
            |--------------------------------------------------------------------------
            | Metadata
            |--------------------------------------------------------------------------
            */

            featureVersion: $feature->feature_version,

            snapshotDate: $feature->snapshot_date,

            generatedAt: $feature->generated_at,

            /*
            |--------------------------------------------------------------------------
            | Computed
            |--------------------------------------------------------------------------
            */

            weekdayName: match ($feature->weekday) {

                1 => 'Monday',

                2 => 'Tuesday',

                3 => 'Wednesday',

                4 => 'Thursday',

                5 => 'Friday',

                6 => 'Saturday',

                7 => 'Sunday',

                default => 'Unknown',

            },

            readyForPrediction:

                $feature->predictionResults->isEmpty(),

        );
    }
}