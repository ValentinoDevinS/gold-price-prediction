<?php

declare(strict_types=1);

namespace App\Http\Requests\Performance;

use Illuminate\Foundation\Http\FormRequest;

final class PerformanceIndexRequest extends FormRequest
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

                'max:100',

            ],

            'model_version' => [

                'nullable',

                'string',

                'max:50',

            ],

            'actual_price_date' => [

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

                'in:
                    articleTitle,
                    modelLabel,
                    actualPrice,
                    predictedPrice,
                    percentageError,
                    evaluatedAt',

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