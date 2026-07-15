<?php

namespace App\Http\Requests\FullArticle;

use Illuminate\Foundation\Http\FormRequest;

class StoreFullArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'article_id' => [

                'required',

                'exists:articles,id',

            ],

            'content' => [

                'required',

                'string',

            ],

            'html' => [

                'nullable',

                'string',

            ],

            'author' => [

                'nullable',

                'string',

                'max:255',

            ],

            'image_url' => [

                'nullable',

                'url',

                'max:2000',

            ],

            'word_count' => [

                'required',

                'integer',

                'min:0',

            ],

            'download_status' => [

                'required',

                'string',

                'max:30',

            ],

            'downloaded_at' => [

                'nullable',

                'date',

            ],

        ];
    }
}