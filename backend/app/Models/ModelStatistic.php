<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelStatistic extends Model
{
    use HasFactory;
    use HasUuid;

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

            'ranking_position' => 'integer',

            'total_predictions' => 'integer',

            'best_prediction_count' => 'integer',

            'win_rate' => 'decimal:4',

            'mae' => 'decimal:6',

            'rmse' => 'decimal:6',

            'mape' => 'decimal:6',

            'average_absolute_error' => 'decimal:6',

            'average_percentage_error' => 'decimal:6',

            'difference_from_best' => 'decimal:6',

            'latest_prediction_date' => 'date',

            'calculated_at' => 'datetime',

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Determine whether this model is currently ranked first.
     */
    public function isBestModel(): bool
    {
        return $this->ranking_position === 1;
    }

    /**
     * Determine whether this model has ever won.
     */
    public function hasWins(): bool
    {
        return $this->best_prediction_count > 0;
    }

    /**
     * Determine whether this model has statistics.
     */
    public function hasPredictions(): bool
    {
        return $this->total_predictions > 0;
    }

    /**
     * Determine whether this model has been evaluated.
     */
    public function isCalculated(): bool
    {
        return $this->calculated_at !== null;
    }

    /**
     * Calculate win percentage.
     *
     * (Uses stored value, mainly for readability.)
     */
    public function winPercentage(): float
    {
        return (float) $this->win_rate;
    }

    /**
     * Difference from the best model.
     */
    public function difference(): float
    {
        return (float) $this->difference_from_best;
    }
}