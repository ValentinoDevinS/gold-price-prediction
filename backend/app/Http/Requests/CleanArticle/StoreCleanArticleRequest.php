<?php

namespace App\Http\Requests\CleanArticle;

use Illuminate\Foundation\Http\FormRequest;

class StoreCleanArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'full_article_uuid' => [
                'required',
                'uuid',
                'exists:full_articles,uuid',
            ],

            'clean_content' => [
                'required',
                'string',
            ],

            'original_word_count' => [
                'required',
                'integer',
                'min:0',
            ],

            'clean_word_count' => [
                'required',
                'integer',
                'min:0',
            ],

            'cleaner_version' => [
                'required',
                'string',
                'max:50',
            ],

            'cleaned_at' => [
                'required',
                'date',
            ],

        ];
    }
}