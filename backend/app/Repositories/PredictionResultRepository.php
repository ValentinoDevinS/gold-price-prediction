<?php

namespace App\Repositories;

use App\Models\PredictionResult;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * Get all predictions for one Feature Snapshot.
     */
    public function getByFeatureSnapshotId(
        int $featureSnapshotId
    ): Collection {

        return

            $this->model
                ->where(
                    'feature_snapshot_id',
                    $featureSnapshotId
                )
                ->orderBy(
                    'model_name'
                )
                ->get();

    }
}