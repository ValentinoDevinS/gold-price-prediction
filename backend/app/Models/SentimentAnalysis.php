<?php

namespace App\Models;

use App\Enums\SentimentLabel;

class SentimentAnalysis extends BaseModel
{
    protected $fillable = [

        'uuid',

        'clean_article_id',

        'positive_score',

        'neutral_score',

        'negative_score',

        'sentiment_label',

        'model_name',

        'model_version',

        'analyzed_at',

    ];

    protected $casts = [

        'analyzed_at' => 'datetime',

        'sentiment_label' => SentimentLabel::class,

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function cleanArticle()
    {
        return $this->belongsTo(
            CleanArticle::class
        );
    }

    public function featureSnapshot()
    {
        return $this->hasOne(
            FeatureSnapshot::class
        );
    }
}