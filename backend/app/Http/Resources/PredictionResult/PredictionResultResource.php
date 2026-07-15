<?php

namespace App\Http\Resources\PredictionResult;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PredictionResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'uuid' => $this->uuid,

            'feature_snapshot_uuid'
                => $this->featureSnapshot?->uuid,

            'model_name'
                => $this->model_name,

            'model_version'
                => $this->model_version,

            'predicted_price'
                => $this->predicted_price,

            'confidence_score'
                => $this->confidence_score,

            'prediction_date'
                => $this->prediction_date,

            'predicted_at'
                => $this->predicted_at,

            'created_at'
                => $this->created_at,

            'updated_at'
                => $this->updated_at,

        ];
    }
}
