<?php

namespace App\Models;

class FeatureSnapshot extends BaseModel
{
    protected $fillable = [

        'uuid',

        'sentiment_analysis_id',

        /*
        |--------------------------------------------------------------------------
        | Sentiment Features
        |--------------------------------------------------------------------------
        */

        'positive_score',

        'neutral_score',

        'negative_score',

        /*
        |--------------------------------------------------------------------------
        | Article Features
        |--------------------------------------------------------------------------
        */

        'word_count',

        'article_count',

        'average_sentiment',

        /*
        |--------------------------------------------------------------------------
        | Rolling Features
        |--------------------------------------------------------------------------
        */

        'rolling_sentiment_3d',

        'rolling_sentiment_7d',

        'rolling_sentiment_14d',

        /*
        |--------------------------------------------------------------------------
        | Time Features
        |--------------------------------------------------------------------------
        */

        'weekday',

        'month',

        'quarter',

        'is_weekend',

        /*
        |--------------------------------------------------------------------------
        | Market Features
        |--------------------------------------------------------------------------
        */

        'gold_price',

        'gold_change_percent',

        'usd_index',

        'etf_flow',

        'trading_volume',

        /*
        |--------------------------------------------------------------------------
        | Metadata
        |--------------------------------------------------------------------------
        */

        'feature_version',

        'snapshot_date',

        'generated_at',

    ];

    protected $casts = [

        'snapshot_date' => 'date',

        'generated_at' => 'datetime',

        'is_weekend' => 'boolean',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function sentimentAnalysis()
    {
        return $this->belongsTo(
            SentimentAnalysis::class
        );
    }

    public function predictionResults()
    {
        return $this->hasMany(
            PredictionResult::class
        );
    }
}