<?php

namespace App\Models;

use App\Enums\ArticleStatus;

class Article extends BaseModel
{
    protected $fillable = [

        'uuid',

        'title',

        'url',

        'url_hash',

        'source',

        'published_at',

        'language',

        'country',

        'keyword',

        'scraper',

        'status',

        'scraped_at',

    ];

    protected $casts = [

        'published_at' => 'datetime',

        'scraped_at' => 'datetime',

        'status' => ArticleStatus::class,

    ];

    public function fullArticle()
    {
        return $this->hasOne(FullArticle::class);
    }
}