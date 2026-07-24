<?php

namespace App\Support\Ui\Styles;

use App\Enums\Ui\InputSize;
use App\Support\Ui\ClassBuilder;

class InputStyle
{
    public static function make(
        InputSize $size,
        bool $hasError = false,
        bool $disabled = false,
    ): string {
        return (new ClassBuilder())
            ->add(self::base())
            ->add(self::size($size))
            ->add(self::state($hasError, $disabled))
            ->build();
    }

    protected static function base(): string
    {
        return implode(' ', [
            'w-full',

            'rounded-button',

            'border',
            'border-border',

            'bg-card',
            'text-text',

            'placeholder:text-text-secondary',

            'transition-all',
            'duration-normal',

            'focus:outline-none',
            'focus:ring-2',
            'focus:ring-primary',
            'focus:border-primary',
        ]);
    }

    protected static function size(InputSize $size): string
    {
        return match ($size) {

            InputSize::Small => implode(' ', [
                'h-9',
                'px-3',
                'text-sm',
            ]),

            InputSize::Medium => implode(' ', [
                'h-10',
                'px-4',
                'text-sm',
            ]),

            InputSize::Large => implode(' ', [
                'h-12',
                'px-4',
                'text-base',
            ]),
        };
    }

    protected static function state(
        bool $hasError,
        bool $disabled,
    ): string {

        if ($disabled) {
            return implode(' ', [
                'opacity-60',
                'cursor-not-allowed',
                'bg-background',
            ]);
        }

        if ($hasError) {
            return implode(' ', [
                'border-danger',
                'focus:border-danger',
                'focus:ring-danger',
            ]);
        }

        return '';
    }
}