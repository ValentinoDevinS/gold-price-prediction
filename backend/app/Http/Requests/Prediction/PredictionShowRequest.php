<?php

declare(strict_types=1);

namespace App\Http\Requests\Prediction;

use Illuminate\Foundation\Http\FormRequest;

final class PredictionShowRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }
}