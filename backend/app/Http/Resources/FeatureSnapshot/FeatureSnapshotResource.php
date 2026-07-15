<?php

namespace App\Http\Resources\FeatureSnapshot;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeatureSnapshotResource extends JsonResource
{
    public function toArray(
        Request $request
    ): array {

        return [

            'uuid' => $this->uuid,

            'sentiment_analysis_uuid'
                => $this->sentimentAnalysis?->uuid,

            'positive_score'
                => $this->positive_score,

            'neutral_score'
                => $this->neutral_score,

            'negative_score'
                => $this->negative_score,

            'word_count'
                => $this->word_count,

            'article_count'
                => $this->article_count,

            'average_sentiment'
                => $this->average_sentiment,

            'rolling_sentiment_3d'
                => $this->rolling_sentiment_3d,

            'rolling_sentiment_7d'
                => $this->rolling_sentiment_7d,

            'rolling_sentiment_14d'
                => $this->rolling_sentiment_14d,

            'weekday'
                => $this->weekday,

            'month'
                => $this->month,

            'quarter'
                => $this->quarter,

            'is_weekend'
                => $this->is_weekend,

            'gold_price'
                => $this->gold_price,

            'gold_change_percent'
                => $this->gold_change_percent,

            'usd_index'
                => $this->usd_index,

            'etf_flow'
                => $this->etf_flow,

            'trading_volume'
                => $this->trading_volume,

            'feature_version'
                => $this->feature_version,

            'snapshot_date'
                => $this->snapshot_date,

            'generated_at'
                => $this->generated_at,

            'created_at'
                => $this->created_at,

            'updated_at'
                => $this->updated_at,

        ];
    }
}