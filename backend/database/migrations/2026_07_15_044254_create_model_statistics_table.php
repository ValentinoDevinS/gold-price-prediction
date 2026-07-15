<?php

namespace App\Models;

class ModelStatistic extends BaseModel
{
    protected $fillable = [

        'uuid',

        'model_name',

        'ranking_position',

        'total_predictions',

        'best_prediction_count',

        'win_rate',

        'mae',

        'rmse',

        'mape',

        'average_absolute_error',

        'average_percentage_error',

        'difference_from_best',

        'latest_prediction_date',

        'calculated_at',

    ];

    protected function casts(): array
    {
        return [

            'ranking_position'
                => 'integer',

            'total_predictions'
                => 'integer',

            'best_prediction_count'
                => 'integer',

            'win_rate'
                => 'decimal:4',

            'mae'
                => 'decimal:6',

            'rmse'
                => 'decimal:6',

            'mape'
                => 'decimal:6',

            'average_absolute_error'
                => 'decimal:6',

            'average_percentage_error'
                => 'decimal:6',

            'difference_from_best'
                => 'decimal:6',

            'latest_prediction_date'
                => 'date',

            'calculated_at'
                => 'datetime',

        ];
    }
}