<?php

namespace App\Repositories;

use App\Models\SentimentAnalysis;

class SentimentAnalysisRepository extends BaseRepository
{
    protected array $filterable = [

        'sentiment_label',

        'model_name',

    ];

    protected array $sortable = [

        'analyzed_at',

        'created_at',

    ];

    protected string $defaultSort = 'analyzed_at';

    protected string $defaultDirection = 'desc';

    public function __construct(
        SentimentAnalysis $model
    ) {
        parent::__construct($model);
    }
}