<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelStatisticHistory extends Model
{
    use HasFactory;
    use HasUuid;

    protected $fillable = [

        'uuid',

        'snapshot_uuid',

        'snapshot_sequence',

        'snapshot_date',

        'evaluation_scope',

        'evaluation_period_start',

        'evaluation_period_end',

        'model_name',

        'ranking_position',

        'previous_ranking',

        'ranking_change',

        'is_snapshot_winner',

        'total_predictions',

        'best_prediction_count',

        'win_rate',

        'mae',

        'rmse',

        'mape',

        'average_absolute_error',

        'average_percentage_error',

        'difference_from_best',

        'calculated_at',

    ];

    protected function casts(): array
    {
        return [

            'snapshot_date' => 'date',

            'evaluation_period_start' => 'date',

            'evaluation_period_end' => 'date',

            'ranking_position' => 'integer',

            'previous_ranking' => 'integer',

            'ranking_change' => 'integer',

            'is_snapshot_winner' => 'boolean',

            'total_predictions' => 'integer',

            'best_prediction_count' => 'integer',

            'win_rate' => 'decimal:4',

            'mae' => 'decimal:6',

            'rmse' => 'decimal:6',

            'mape' => 'decimal:6',

            'average_absolute_error' => 'decimal:6',

            'average_percentage_error' => 'decimal:6',

            'difference_from_best' => 'decimal:6',

            'calculated_at' => 'datetime',

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    public function isSnapshotWinner(): bool
    {
        return $this->is_snapshot_winner;
    }

    public function hasRankingChanged(): bool
    {
        return $this->ranking_change != 0;
    }

    public function hasImprovedRanking(): bool
    {
        return $this->ranking_change > 0;
    }

    public function hasDroppedRanking(): bool
    {
        return $this->ranking_change < 0;
    }

    public function isCurrentLeader(): bool
    {
        return $this->ranking_position === 1;
    }
}