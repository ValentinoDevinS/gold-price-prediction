<?php

declare(strict_types=1);

namespace App\Http\Requests\CleanArticle;

use Illuminate\Foundation\Http\FormRequest;

final class CleanArticleShowRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'uuid' => [
                'required',
                'uuid',
            ],
        ];
    }
}