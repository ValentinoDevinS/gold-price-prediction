<?php

namespace App\Models;

class PredictionResult extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Supported Models
    |--------------------------------------------------------------------------
    */

    public const MODEL_LSTM = 'LSTM';

    public const MODEL_CNN = 'CNN';

    public const MODEL_ANN = 'ANN';

    public const MODEL_ENSEMBLE = 'ENSEMBLE';

    /*
    |--------------------------------------------------------------------------
    | Available Models
    |--------------------------------------------------------------------------
    */

    public const AVAILABLE_MODELS = [

        self::MODEL_LSTM,

        self::MODEL_CNN,

        self::MODEL_ANN,

        self::MODEL_ENSEMBLE,

    ];

    /**
     * Required prediction models before ensemble generation.
     */
    public static function requiredModels(): array
    {
        return [

            self::MODEL_LSTM,

            self::MODEL_CNN,

            self::MODEL_ANN,

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */

    protected $table = 'prediction_results';

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'uuid',

        'feature_snapshot_id',

        'model_name',

        'model_version',

        'predicted_price',

        'confidence_score',

        'prediction_date',

        'predicted_at',

    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'predicted_price' => 'decimal:2',

        'confidence_score' => 'decimal:6',

        'prediction_date' => 'date',

        'predicted_at' => 'datetime',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function featureSnapshot()
    {
        return $this->belongsTo(
            FeatureSnapshot::class
        );
    }

    public function evaluation()
    {
        return $this->hasOne(
            PredictionEvaluation::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public static function availableModels(): array
    {
        return self::AVAILABLE_MODELS;
    }

    public function isLstm(): bool
    {
        return $this->model_name === self::MODEL_LSTM;
    }

    public function isCnn(): bool
    {
        return $this->model_name === self::MODEL_CNN;
    }

    public function isAnn(): bool
    {
        return $this->model_name === self::MODEL_ANN;
    }

    public function isEnsemble(): bool
    {
        return $this->model_name === self::MODEL_ENSEMBLE;
    }

    public function isLatest(): bool
    {
        return $this->model_version === 'latest';
    }

    public function isFinal(): bool
    {
        return $this->model_version === 'final';
    }
}