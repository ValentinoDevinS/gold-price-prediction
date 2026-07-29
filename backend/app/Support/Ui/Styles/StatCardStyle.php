<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

final class StatCardStyle
{
    public function wrapper(): string
    {
        return implode(' ', [
            'rounded-xl',
            'border',
            'bg-white',
            'shadow-sm',
            'p-6',
        ]);
    }

    public function title(): string
    {
        return implode(' ', [
            'text-sm',
            'font-medium',
            'text-gray-500',
        ]);
    }

    public function value(): string
    {
        return implode(' ', [
            'mt-2',
            'text-3xl',
            'font-bold',
            'tracking-tight',
            'text-gray-900',
        ]);
    }

    public function description(): string
    {
        return implode(' ', [
            'mt-2',
            'text-sm',
            'text-gray-500',
        ]);
    }

    public function icon(): string
    {
        return implode(' ', [
            'ml-4',
            'text-4xl',
        ]);
    }
}