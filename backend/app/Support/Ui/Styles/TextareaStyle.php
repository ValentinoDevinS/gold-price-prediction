<?php

namespace App\Support\Ui\Styles;

use App\Enums\Ui\InputSize;
use App\Enums\Ui\TextareaResize;
use App\Support\Ui\ClassBuilder;

class TextareaStyle
{
    public static function make(
        InputSize $size,
        TextareaResize $resize,
        bool $hasError = false,
        bool $disabled = false,
    ): string {
        return (new ClassBuilder())
            ->add(self::base())
            ->add(self::size($size))
            ->add(self::resize($resize))
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
                'min-h-24',
                'px-3',
                'py-2',
                'text-sm',
            ]),

            InputSize::Medium => implode(' ', [
                'min-h-32',
                'px-4',
                'py-3',
                'text-sm',
            ]),

            InputSize::Large => implode(' ', [
                'min-h-40',
                'px-4',
                'py-4',
                'text-base',
            ]),
        };
    }

    protected static function resize(TextareaResize $resize): string
    {
        return match ($resize) {

            TextareaResize::None => 'resize-none',

            TextareaResize::Vertical => 'resize-y',

            TextareaResize::Horizontal => 'resize-x',

            TextareaResize::Both => 'resize',
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