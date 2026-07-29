<?php

declare(strict_types=1);

namespace App\Http\Requests\CleanArticle;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CleanArticleIndexRequest extends FormRequest
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

            'search' => [
                'nullable',
                'string',
                'max:255',
            ],

            'cleaner_version' => [
                'nullable',
                'string',
                'max:100',
            ],

            'sort' => [
                'nullable',
                Rule::in([
                    'articleTitle',
                    'articleSource',
                    'originalWordCount',
                    'cleanWordCount',
                    'cleanerVersion',
                    'cleanedAt',
                ]),
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