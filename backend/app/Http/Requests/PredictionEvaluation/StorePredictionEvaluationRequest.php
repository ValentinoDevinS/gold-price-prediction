<?php

namespace App\Http\Requests\PredictionEvaluation;

use Illuminate\Foundation\Http\FormRequest;

class StorePredictionEvaluationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'actual_price' => [

                'required',

                'numeric',

            ],

            'actual_price_date' => [

                'required',

                'date',

            ],

        ];
    }
}