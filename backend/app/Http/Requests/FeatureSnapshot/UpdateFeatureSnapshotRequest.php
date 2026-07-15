<?php

namespace App\Http\Requests\FeatureSnapshot;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFeatureSnapshotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'positive_score' => ['sometimes','numeric'],
            'neutral_score' => ['sometimes','numeric'],
            'negative_score' => ['sometimes','numeric'],

            'word_count' => ['sometimes','integer','min:0'],
            'article_count' => ['sometimes','integer','min:0'],
            'average_sentiment' => ['sometimes','numeric'],

            'rolling_sentiment_3d' => ['nullable','numeric'],
            'rolling_sentiment_7d' => ['nullable','numeric'],
            'rolling_sentiment_14d' => ['nullable','numeric'],

            'weekday' => ['sometimes','integer','between:1,7'],
            'month' => ['sometimes','integer','between:1,12'],
            'quarter' => ['sometimes','integer','between:1,4'],

            'is_weekend' => ['sometimes','boolean'],

            'gold_price' => ['nullable','numeric'],
            'gold_change_percent' => ['nullable','numeric'],
            'usd_index' => ['nullable','numeric'],
            'etf_flow' => ['nullable','numeric'],
            'trading_volume' => ['nullable','numeric'],

            'feature_version' => [
                'sometimes',
                'string',
                'max:30',
            ],

            'snapshot_date' => [
                'sometimes',
                'date',
            ],

            'generated_at' => [
                'sometimes',
                'date',
            ],

        ];
    }
}