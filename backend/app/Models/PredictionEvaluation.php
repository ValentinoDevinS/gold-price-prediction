<?php

namespace App\Models;

class PredictionEvaluation extends BaseModel
{
    protected $fillable = [

        'uuid',

        'prediction_result_id',

        'ensemble_result_id',

        'actual_price',

        'actual_price_date',

        'absolute_error',

        'squared_error',

        'percentage_error',

        'evaluated_at',

    ];

    protected function casts(): array
    {
        return [

            'actual_price'
                => 'decimal:2',

            'actual_price_date'
                => 'date',

            'absolute_error'
                => 'decimal:6',

            'squared_error'
                => 'decimal:6',

            'percentage_error'
                => 'decimal:6',

            'evaluated_at'
                => 'datetime',

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function predictionResult()
    {
        return $this->belongsTo(
            PredictionResult::class
        );
    }

    public function ensembleResult()
    {
        return $this->belongsTo(
            EnsembleResult::class
        );
    }
}