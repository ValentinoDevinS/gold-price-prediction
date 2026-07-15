<?php

namespace App\Repositories;

use App\Models\PredictionResult;

class PredictionResultRepository extends BaseRepository
{
    protected array $searchable = [

        'model_name',

        'model_version',

    ];

    protected array $filterable = [

        'model_name',

        'model_version',

        'prediction_date',

    ];

    protected array $sortable = [

        'prediction_date',

        'predicted_at',

        'created_at',

        'updated_at',

    ];

    protected string $defaultSort = 'prediction_date';

    protected string $defaultDirection = 'desc';

    public function __construct(
        PredictionResult $model
    ) {
        parent::__construct($model);
    }
}