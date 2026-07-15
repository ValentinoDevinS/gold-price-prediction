<?php

namespace App\Http\Resources\ModelStatisticHistory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModelStatisticHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(
        Request $request
    ): array {

        return [

            'uuid'

                =>

                $this->uuid,

            /*
            |--------------------------------------------------------------------------
            | Snapshot
            |--------------------------------------------------------------------------
            */

            'snapshot_uuid'

                =>

                $this->snapshot_uuid,

            'snapshot_sequence'

                =>

                $this->snapshot_sequence,

            'snapshot_date'

                =>

                $this->snapshot_date,

            /*
            |--------------------------------------------------------------------------
            | Evaluation
            |--------------------------------------------------------------------------
            */

            'evaluation_scope'

                =>

                $this->evaluation_scope,

            'evaluation_period_start'

                =>

                $this->evaluation_period_start,

            'evaluation_period_end'

                =>

                $this->evaluation_period_end,

            /*
            |--------------------------------------------------------------------------
            | Model
            |--------------------------------------------------------------------------
            */

            'model_name'

                =>

                $this->model_name,

            'ranking_position'

                =>

                $this->ranking_position,

            'previous_ranking'

                =>

                $this->previous_ranking,

            'ranking_change'

                =>

                $this->ranking_change,

            'is_snapshot_winner'

                =>

                $this->is_snapshot_winner,

            /*
            |--------------------------------------------------------------------------
            | Statistics
            |--------------------------------------------------------------------------
            */

            'total_predictions'

                =>

                $this->total_predictions,

            'best_prediction_count'

                =>

                $this->best_prediction_count,

            'win_rate'

                =>

                $this->win_rate,

            'mae'

                =>

                $this->mae,

            'rmse'

                =>

                $this->rmse,

            'mape'

                =>

                $this->mape,

            'average_absolute_error'

                =>

                $this->average_absolute_error,

            'average_percentage_error'

                =>

                $this->average_percentage_error,

            'difference_from_best'

                =>

                $this->difference_from_best,

            /*
            |--------------------------------------------------------------------------
            | Metadata
            |--------------------------------------------------------------------------
            */

            'calculated_at'

                =>

                $this->calculated_at,

            'created_at'

                =>

                $this->created_at,

            'updated_at'

                =>

                $this->updated_at,

        ];

    }
}