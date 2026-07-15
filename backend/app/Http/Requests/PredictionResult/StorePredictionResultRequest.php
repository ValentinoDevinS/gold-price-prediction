<?php

namespace App\Http\Requests\PredictionResult;

use App\Models\PredictionResult;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePredictionResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'feature_snapshot_uuid' => [

                'required',

                'uuid',

                'exists:feature_snapshots,uuid',

            ],

            'model_name' => [

                'required',

                Rule::in(
                    PredictionResult::availableModels()
                ),

            ],

            'model_version' => [

                'required',

                'string',

                'max:30',

            ],

            'predicted_price' => [

                'required',

                'numeric',

            ],

            'confidence_score' => [

                'sometimes',

                'nullable',

                'numeric',

            ],

            'prediction_date' => [

                'required',

                'date',

            ],

            'predicted_at' => [

                'required',

                'date',

            ],

        ];
    }
}