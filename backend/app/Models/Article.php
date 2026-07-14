<?php

namespace App\Models;

use App\Enums\ArticleStatus;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends BaseModel
{

    use HasFactory;

    protected $table = 'articles';

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

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function fullArticle()
    {
        return $this->hasOne(FullArticle::class);
    }
}