<?php

namespace App\Http\Resources\EnsembleResult;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnsembleResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [

            'uuid' => $this->uuid,

            'feature_snapshot_uuid'
                => $this->featureSnapshot?->uuid,

            'ensemble_method'
                => $this->ensemble_method,

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