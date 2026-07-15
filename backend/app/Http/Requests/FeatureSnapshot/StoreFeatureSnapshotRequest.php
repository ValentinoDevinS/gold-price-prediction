<?php

namespace App\Http\Requests\FeatureSnapshot;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeatureSnapshotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'sentiment_analysis_uuid' => [
                'required',
                'uuid',
                'exists:sentiment_analyses,uuid',
            ],

            /*
            |--------------------------------------------------------------------------
            | Sentiment Features
            |--------------------------------------------------------------------------
            */

            'positive_score' => [
                'required',
                'numeric',
            ],

            'neutral_score' => [
                'required',
                'numeric',
            ],

            'negative_score' => [
                'required',
                'numeric',
            ],

            /*
            |--------------------------------------------------------------------------
            | Article Features
            |--------------------------------------------------------------------------
            */

            'word_count' => [
                'required',
                'integer',
                'min:0',
            ],

            'article_count' => [
                'required',
                'integer',
                'min:0',
            ],

            'average_sentiment' => [
                'required',
                'numeric',
            ],

            /*
            |--------------------------------------------------------------------------
            | Rolling Features
            |--------------------------------------------------------------------------
            */

            'rolling_sentiment_3d' => [
                'nullable',
                'numeric',
            ],

            'rolling_sentiment_7d' => [
                'nullable',
                'numeric',
            ],

            'rolling_sentiment_14d' => [
                'nullable',
                'numeric',
            ],

            /*
            |--------------------------------------------------------------------------
            | Time Features
            |--------------------------------------------------------------------------
            */

            'weekday' => [
                'required',
                'integer',
                'between:1,7',
            ],

            'month' => [
                'required',
                'integer',
                'between:1,12',
            ],

            'quarter' => [
                'required',
                'integer',
                'between:1,4',
            ],

            'is_weekend' => [
                'required',
                'boolean',
            ],

            /*
            |--------------------------------------------------------------------------
            | Market Features
            |--------------------------------------------------------------------------
            */

            'gold_price' => [
                'nullable',
                'numeric',
            ],

            'gold_change_percent' => [
                'nullable',
                'numeric',
            ],

            'usd_index' => [
                'nullable',
                'numeric',
            ],

            'etf_flow' => [
                'nullable',
                'numeric',
            ],

            'trading_volume' => [
                'nullable',
                'numeric',
            ],

            /*
            |--------------------------------------------------------------------------
            | Metadata
            |--------------------------------------------------------------------------
            */

            'feature_version' => [
                'required',
                'string',
                'max:30',
            ],

            'snapshot_date' => [
                'required',
                'date',
            ],

            'generated_at' => [
                'required',
                'date',
            ],

        ];
    }
}