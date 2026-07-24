<?php

declare(strict_types=1);

namespace App\Support\Ui\Classes;

use App\Enums\Ui\ButtonSize;
use App\Enums\Ui\ButtonVariant;

final class ButtonClasses
{
    public static function base(): string
    {
        return implode(' ', [
            'inline-flex',
            'items-center',
            'justify-center',
            'font-medium',
            'transition-all',
            'duration-normal',
            'focus:outline-none',
            'focus:ring-2',
            'focus:ring-primary',
            'disabled:opacity-50',
            'disabled:cursor-not-allowed',
        ]);
    }

    public static function variant(ButtonVariant $variant): string
    {
        return match ($variant) {

            ButtonVariant::Primary =>
                'bg-primary hover:bg-primary-hover text-white',

            ButtonVariant::Secondary =>
                'bg-card border border-border text-text hover:bg-divider',

            ButtonVariant::Success =>
                'bg-success text-white',

            ButtonVariant::Warning =>
                'bg-warning text-white',

            ButtonVariant::Danger =>
                'bg-danger text-white',

            ButtonVariant::Ghost =>
                'bg-transparent hover:bg-divider text-text',
        };
    }

    public static function size(ButtonSize $size): string
    {
        return match ($size) {

            ButtonSize::Small =>
                'h-9 px-3 text-sm rounded-button',

            ButtonSize::Medium =>
                'h-10 px-5 text-sm rounded-button',

            ButtonSize::Large =>
                'h-11 px-6 text-base rounded-button',
        };
    }
}