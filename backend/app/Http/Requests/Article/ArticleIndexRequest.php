<?php

declare(strict_types=1);

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

final class ArticleIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

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
                'min:1',
                'max:100',
            ],

            'status' => [
                'nullable',
                'string',
            ],

            'source' => [
                'nullable',
                'string',
                'max:100',
            ],

            'language' => [
                'nullable',
                'string',
                'max:10',
            ],

            'country' => [
                'nullable',
                'string',
                'max:10',
            ],

            'scraper' => [
                'nullable',
                'string',
                'max:100',
            ],

        ];
    }
}