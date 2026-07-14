<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'title' => [
                'sometimes',
                'string',
                'max:500',
            ],

            'url' => [
                'sometimes',
                'url',
                'max:2000',
            ],

            'source' => [
                'sometimes',
                'string',
                'max:100',
            ],

            'published_at' => [
                'nullable',
                'date',
            ],

            'language' => [
                'sometimes',
                'string',
                'max:20',
            ],

            'country' => [
                'sometimes',
                'string',
                'max:50',
            ],

            'keyword' => [
                'sometimes',
                'string',
                'max:100',
            ],

            'scraper' => [
                'sometimes',
                'string',
                'max:100',
            ],

            'scraped_at' => [
                'sometimes',
                'date',
            ],

        ];
    }
}
