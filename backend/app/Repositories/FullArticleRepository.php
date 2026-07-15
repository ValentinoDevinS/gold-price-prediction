<?php

namespace App\Repositories;

use App\Models\FullArticle;

class FullArticleRepository extends BaseRepository
{
    protected array $searchable = [

        'content',

        'author',

    ];

    protected array $filterable = [

        'download_status',

    ];

    protected array $sortable = [

        'downloaded_at',

        'created_at',

        'updated_at',

        'word_count',

    ];

    protected array $with = [

        'article',

    ];

    protected string $defaultSort = 'downloaded_at';

    public function __construct(
        FullArticle $model
    ) {
        parent::__construct($model);
    }
}