<?php

declare(strict_types=1);

namespace App\Http\Requests\Training;

use App\Enums\ModelStatus;
use App\Enums\ModelType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class TrainingIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [

            'search' => [
                'nullable',
                'string',
                'max:255',
            ],

            'model_type' => [
                'nullable',
                Rule::enum(ModelType::class),
            ],

            'status' => [
                'nullable',
                Rule::enum(ModelStatus::class),
            ],

            'sort' => [
                'nullable',
                'string',
            ],

            'direction' => [
                'nullable',
                Rule::in([
                    'asc',
                    'desc',
                ]),
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