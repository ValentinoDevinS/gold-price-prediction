<?php

namespace App\Http\Requests\PredictionResult;

use App\Models\PredictionResult;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePredictionResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'model_name' => [

                'sometimes',

                Rule::in(
                    PredictionResult::AVAILABLE_MODELS
                ),

            ],

            'model_name' => [

                'sometimes',

                Rule::in(
                    PredictionResult::AVAILABLE_MODELS
                ),

            ],

            'model_version' => [

                'sometimes',

                'string',

                'max:30',

            ],

            'predicted_price' => [

                'sometimes',

                'numeric',

            ],

            'confidence_score' => [

                'sometimes',

                'nullable',

                'numeric',

            ],

            'prediction_date' => [

                'sometimes',

                'date',

            ],

            'predicted_at' => [

                'sometimes',

                'date',

            ],

        ];
    }
}