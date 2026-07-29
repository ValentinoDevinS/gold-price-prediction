<?php

declare(strict_types=1);

namespace App\Http\Requests\GoldPrice;

use Illuminate\Foundation\Http\FormRequest;

final class GoldPriceIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Query string validation.
     */
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:100'],

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
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
                'between:1,100',
            ],
        ];
    }
}