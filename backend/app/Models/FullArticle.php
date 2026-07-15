<?php

namespace App\Models;

class FullArticle extends BaseModel
{
    protected $fillable = [

        'uuid',

        'article_id',

        'content',

        'html',

        'author',

        'image_url',

        'word_count',

        'download_status',

        'downloaded_at',

    ];

    protected $casts = [

        'downloaded_at' => 'datetime',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function article()
    {
        return $this->belongsTo(
            Article::class
        );
    }

    public function cleanArticle()
    {
        return $this->hasOne(
            CleanArticle::class
        );
    }
}