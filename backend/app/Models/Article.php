<?php

namespace App\Models;

class Article extends BaseModel
{
    protected $fillable = [

        'uuid',

        'title',

        'url',

        'source',

        'published_at',

        'language',

        'country',

        'keyword',

        'scraper',

        'status',

        'scraped_at'

    ];

    protected $casts = [

        'published_at'=>'datetime',

        'scraped_at'=>'datetime'

    ];

    public function fullArticle()
    {
        return $this->hasOne(FullArticle::class);
    }
}