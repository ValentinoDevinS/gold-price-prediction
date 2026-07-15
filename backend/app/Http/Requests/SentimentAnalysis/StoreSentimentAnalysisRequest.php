<?php

namespace App\Http\Requests\SentimentAnalysis;

use App\Enums\SentimentLabel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreSentimentAnalysisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'clean_article_uuid' => [
                'required',
                'uuid',
                'exists:clean_articles,uuid',
            ],

            'positive_score' => [
                'required',
                'numeric',
                'between:0,1',
            ],

            'neutral_score' => [
                'required',
                'numeric',
                'between:0,1',
            ],

            'negative_score' => [
                'required',
                'numeric',
                'between:0,1',
            ],

            'sentiment_label' => [
                'required',
                new Enum(SentimentLabel::class),
            ],

            'model_name' => [
                'required',
                'string',
                'max:100',
            ],

            'model_version' => [
                'required',
                'string',
                'max:30',
            ],

            'analyzed_at' => [
                'required',
                'date',
            ],

        ];
    }
}