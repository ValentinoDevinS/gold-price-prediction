<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

use App\Enums\Ui\ButtonSize;
use App\Enums\Ui\ButtonVariant;
use App\Support\Ui\ClassBuilder;

final class ButtonStyle
{
    public static function make(
        ButtonVariant $variant,
        ButtonSize $size
    ): string {
        return (new ClassBuilder())
            ->add(self::base())
            ->add(self::variant($variant))
            ->add(self::size($size))
            ->build();
    }

    private static function base(): string
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

    private static function variant(ButtonVariant $variant): string
    {
        return match ($variant) {
            ButtonVariant::Primary =>
                'bg-primary text-white hover:bg-primary-hover',

            ButtonVariant::Secondary =>
                'bg-card border border-border text-text hover:bg-divider',

            ButtonVariant::Success =>
                'bg-success text-white',

            ButtonVariant::Warning =>
                'bg-warning text-white',

            ButtonVariant::Danger =>
                'bg-danger text-white',

            ButtonVariant::Ghost =>
                'bg-transparent text-text hover:bg-divider',
        };
    }

    private static function size(ButtonSize $size): string
    {
        return match ($size) {
            ButtonSize::Small =>
                'h-9 px-3 text-sm rounded-button',

            ButtonSize::Medium =>
                'h-10 px-4 text-sm rounded-button',

            ButtonSize::Large =>
                'h-11 px-6 text-base rounded-button',
        };
    }
}