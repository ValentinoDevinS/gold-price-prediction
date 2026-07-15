<?php

namespace App\Repositories;

use App\Models\CleanArticle;

class CleanArticleRepository extends BaseRepository
{
    protected array $searchable = [

        'clean_content',

    ];

    protected array $sortable = [

        'cleaned_at',

        'created_at',

    ];

    protected array $with = [

        'fullArticle',

    ];

    protected string $defaultSort = 'cleaned_at';

    protected string $defaultDirection = 'desc';

    public function __construct(
        CleanArticle $model
    ) {
        parent::__construct($model);
    }
}