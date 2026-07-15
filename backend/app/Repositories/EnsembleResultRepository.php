<?php

namespace App\Repositories;

use App\Models\EnsembleResult;

class EnsembleResultRepository extends BaseRepository
{
    protected array $searchable = [

        'ensemble_method',

        'model_version',

    ];

    protected array $filterable = [

        'ensemble_method',

        'prediction_date',

    ];

    protected array $sortable = [

        'prediction_date',

        'predicted_at',

        'created_at',

    ];

    protected string $defaultSort = 'prediction_date';

    protected string $defaultDirection = 'desc';

    public function __construct(
        EnsembleResult $model
    ) {
        parent::__construct($model);
    }

    public function findByFeatureSnapshotId(
        int $featureSnapshotId
    ): ?EnsembleResult {

        return $this->model
            ->where(
                'feature_snapshot_id',
                $featureSnapshotId
            )
            ->first();

    }
}