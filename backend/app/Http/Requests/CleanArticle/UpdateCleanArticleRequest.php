<?php

namespace App\Http\Requests\CleanArticle;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCleanArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'clean_content' => [
                'sometimes',
                'string',
            ],

            'original_word_count' => [
                'sometimes',
                'integer',
                'min:0',
            ],

            'clean_word_count' => [
                'sometimes',
                'integer',
                'min:0',
            ],

            'cleaner_version' => [
                'sometimes',
                'string',
                'max:50',
            ],

            'cleaned_at' => [
                'sometimes',
                'date',
            ],

        ];
    }
}