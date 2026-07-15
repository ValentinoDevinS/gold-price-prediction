<?php

namespace App\Models;

class CleanArticle extends BaseModel
{
    protected $fillable = [

        'uuid',

        'full_article_id',

        'clean_content',

        'original_word_count',

        'clean_word_count',

        'cleaner_version',

        'cleaned_at',

    ];

    protected $casts = [

        'cleaned_at' => 'datetime',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function fullArticle()
    {
        return $this->belongsTo(
            FullArticle::class
        );
    }

    public function sentimentAnalysis()
    {
        return $this->hasOne(
            SentimentAnalysis::class
        );
    }
}