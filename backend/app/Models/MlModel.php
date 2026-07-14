<?php

namespace App\Models;

class MlModel extends BaseModel
{
    protected $table = 'ml_models';

    protected $fillable = [
        'uuid',
        'model_name',
        'model_version',
        'model_type',
        'model_path',
        'scaler_path',
        'is_active',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}