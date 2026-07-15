<?php

namespace App\Http\Resources\PredictionEvaluation;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PredictionEvaluationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [

            'uuid'
                => $this->uuid,

            'prediction_result_uuid'
                => $this->predictionResult?->uuid,

            'ensemble_result_uuid'
                => $this->ensembleResult?->uuid,

            'actual_price'
                => $this->actual_price,

            'actual_price_date'
                => $this->actual_price_date,

            'absolute_error'
                => $this->absolute_error,

            'squared_error'
                => $this->squared_error,

            'percentage_error'
                => $this->percentage_error,

            'evaluated_at'
                => $this->evaluated_at,

            'created_at'
                => $this->created_at,

            'updated_at'
                => $this->updated_at,

        ];
    }
}