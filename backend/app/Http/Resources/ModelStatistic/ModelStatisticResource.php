<?php

namespace App\Http\Resources\ModelStatistic;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModelStatisticResource extends JsonResource
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

            'model_name'

                =>

                $this->model_name,

            'ranking_position'

                =>

                $this->ranking_position,

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

            'latest_prediction_date'

                =>

                $this->latest_prediction_date,

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