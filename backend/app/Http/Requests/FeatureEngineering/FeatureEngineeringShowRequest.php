<?php

declare(strict_types=1);

namespace App\Http\Requests\FeatureEngineering;

use Illuminate\Foundation\Http\FormRequest;

final class FeatureEngineeringShowRequest extends FormRequest
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