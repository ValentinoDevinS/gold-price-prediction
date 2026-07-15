<?php

namespace App\Repositories;

use App\Models\FeatureSnapshot;

class FeatureSnapshotRepository extends BaseRepository
{
    protected array $filterable = [

        'feature_version',

        'snapshot_date',

    ];

    protected array $sortable = [

        'snapshot_date',

        'generated_at',

        'created_at',

    ];

    protected string $defaultSort = 'snapshot_date';

    protected string $defaultDirection = 'desc';

    public function __construct(
        FeatureSnapshot $model
    ) {
        parent::__construct($model);
    }
}