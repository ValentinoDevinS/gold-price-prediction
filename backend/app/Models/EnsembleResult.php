<?php

namespace App\Models;

class EnsembleResult extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Supported Methods
    |--------------------------------------------------------------------------
    */

    public const METHOD_AVERAGE = 'AVERAGE';

    public const METHOD_WEIGHTED = 'WEIGHTED_AVERAGE';

    public const METHOD_MEDIAN = 'MEDIAN';

    public const METHOD_STACKING = 'STACKING';

    public static function availableMethods(): array
    {
        return [

            self::METHOD_AVERAGE,

            self::METHOD_WEIGHTED,

            self::METHOD_MEDIAN,

            self::METHOD_STACKING,

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Versions
    |--------------------------------------------------------------------------
    */

    public const VERSION_LATEST = 'latest';

    public const VERSION_FINAL = 'final';

    public static function availableVersions(): array
    {
        return [

            self::VERSION_LATEST,

            self::VERSION_FINAL,

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Fillable
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'uuid',

        'feature_snapshot_id',

        'ensemble_method',

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

    public function isAverage(): bool
    {
        return $this->ensemble_method === self::METHOD_AVERAGE;
    }

    public function isWeighted(): bool
    {
        return $this->ensemble_method === self::METHOD_WEIGHTED;
    }

    public function isMedian(): bool
    {
        return $this->ensemble_method === self::METHOD_MEDIAN;
    }

    public function isStacking(): bool
    {
        return $this->ensemble_method === self::METHOD_STACKING;
    }

    public function isLatest(): bool
    {
        return $this->model_version === self::VERSION_LATEST;
    }

    public function isFinal(): bool
    {
        return $this->model_version === self::VERSION_FINAL;
    }
}