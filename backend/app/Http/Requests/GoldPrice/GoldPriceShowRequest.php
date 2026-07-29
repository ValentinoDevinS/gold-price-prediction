<?php

declare(strict_types=1);

namespace App\Http\Requests\GoldPrice;

use Illuminate\Foundation\Http\FormRequest;

final class GoldPriceShowRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => [
                'required',
                'date',
            ],
        ];
    }
}