<?php

declare(strict_types=1);

namespace App\Http\Requests\FeatureEngineering;

use Illuminate\Foundation\Http\FormRequest;

final class FeatureEngineeringIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'feature_version' => [
                'nullable',
                'string',
                'max:30',
            ],

            'snapshot_date' => [
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