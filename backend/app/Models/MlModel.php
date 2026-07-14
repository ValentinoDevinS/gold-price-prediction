<?php

namespace App\Models;

use App\Enums\ModelStatus;
use App\Enums\ModelType;

class MlModel extends BaseModel
{
    protected $table = 'ml_models';

    protected $fillable = [

        'uuid',

        'model_name',

        'model_version',

        'model_type',

        'status',

        'trained_from',

        'trained_until',

        'dataset_size',

        'training_time',

        'model_hash',

        'model_path',

        'scaler_path',

        'description'

    ];

    protected $casts = [

        'trained_from'=>'date',

        'trained_until'=>'date',

        'training_time'=>'float',

        'model_type'=>ModelType::class,

        'status'=>ModelStatus::class

    ];

    public function trainingHistories()
    {
        return $this->hasMany(TrainingHistory::class);
    }
}