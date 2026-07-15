<?php

namespace App\Http\Resources\SentimentAnalysis;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SentimentAnalysisResource extends JsonResource
{
    public function toArray(
        Request $request
    ): array {

        return [

            'uuid' => $this->uuid,

            'clean_article_uuid' => $this->cleanArticle?->uuid,

            'positive_score' => $this->positive_score,

            'neutral_score' => $this->neutral_score,

            'negative_score' => $this->negative_score,

            'sentiment_label' => $this->sentiment_label,

            'model_name' => $this->model_name,

            'model_version' => $this->model_version,

            'analyzed_at' => $this->analyzed_at,

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,

        ];
    }
}