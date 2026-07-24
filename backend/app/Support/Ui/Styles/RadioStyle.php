<?php

namespace App\Support\Ui\Styles;

use App\Support\Ui\ClassBuilder;

class RadioStyle
{
    public static function make(
        bool $hasError = false,
        bool $disabled = false,
    ): string {
        return (new ClassBuilder())
            ->add(self::base())
            ->add(self::state($hasError, $disabled))
            ->build();
    }

    protected static function base(): string
    {
        return implode(' ', [
            'h-4',
            'w-4',

            'rounded-full',

            'border',
            'border-border',

            'text-primary',

            'focus:ring-2',
            'focus:ring-primary',
            'focus:ring-offset-0',
        ]);
    }

    protected static function state(
        bool $hasError,
        bool $disabled,
    ): string {

        if ($disabled) {
            return implode(' ', [
                'opacity-60',
                'cursor-not-allowed',
            ]);
        }

        if ($hasError) {
            return implode(' ', [
                'border-danger',
                'focus:ring-danger',
            ]);
        }

        return '';
    }
}