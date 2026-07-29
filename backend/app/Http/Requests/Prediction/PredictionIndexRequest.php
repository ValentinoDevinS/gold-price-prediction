<?php

declare(strict_types=1);

namespace App\Http\Requests\Prediction;

use Illuminate\Foundation\Http\FormRequest;

final class PredictionIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'model_name' => [
                'nullable',
                'string',
                'max:30',
            ],

            'model_version' => [
                'nullable',
                'string',
                'max:30',
            ],

            'prediction_date' => [
                'nullable',
                'date',
            ],

            'search' => [
                'nullable',
                'string',
                'max:255',
            ],

            'sort' => [
                'nullable',
                'string',
            ],

            'direction' => [
                'nullable',
                'in:asc,desc',
            ],

            'per_page' => [
                'nullable',
                'integer',
                'min:10',
                'max:100',
            ],

        ];
    }
}