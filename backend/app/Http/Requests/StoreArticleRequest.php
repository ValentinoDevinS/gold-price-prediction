<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'title' => 'required|string|max:500',

            'url' => 'required|url|max:2000',

            'source' => 'required|string|max:100',

            'published_at' => 'nullable|date',

            'language' => 'required|string|max:20',

            'country' => 'nullable|string|max:50',

            'keyword' => 'required|string|max:100',

            'scraper' => 'required|string|max:100',

            'scraped_at' => 'required|date',

        ];
    }

    
}
