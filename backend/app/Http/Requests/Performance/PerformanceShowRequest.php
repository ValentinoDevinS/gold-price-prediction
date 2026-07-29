<?php

declare(strict_types=1);

namespace App\Http\Requests\Performance;

use Illuminate\Foundation\Http\FormRequest;

final class PerformanceShowRequest extends FormRequest
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