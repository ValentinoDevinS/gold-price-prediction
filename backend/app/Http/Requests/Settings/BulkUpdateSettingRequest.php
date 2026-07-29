<?php

declare(strict_types=1);

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

final class BulkUpdateSettingRequest extends FormRequest
{
    /**
     * Determine whether the user is authorized.
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

            'settings' => [

                'required',

                'array',

            ],

            'settings.*.uuid' => [

                'required',

                'uuid',

            ],

            'settings.*.value' => [

                'required',

            ],

            'settings.*.description' => [

                'nullable',

                'string',

                'max:1000',

            ],

        ];
    }

    /**
     * Custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [

            'settings.required' => 'No settings were submitted.',

            'settings.array' => 'Invalid settings payload.',

        ];
    }
}