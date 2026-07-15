<?php

namespace App\Http\Requests\SentimentAnalysis;

use App\Enums\SentimentLabel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateSentimentAnalysisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'positive_score' => [
                'sometimes',
                'numeric',
                'between:0,1',
            ],

            'neutral_score' => [
                'sometimes',
                'numeric',
                'between:0,1',
            ],

            'negative_score' => [
                'sometimes',
                'numeric',
                'between:0,1',
            ],

            'sentiment_label' => [
                'sometimes',
                new Enum(SentimentLabel::class),
            ],

            'model_name' => [
                'sometimes',
                'string',
                'max:100',
            ],

            'model_version' => [
                'sometimes',
                'string',
                'max:30',
            ],

            'analyzed_at' => [
                'sometimes',
                'date',
            ],

        ];
    }
}