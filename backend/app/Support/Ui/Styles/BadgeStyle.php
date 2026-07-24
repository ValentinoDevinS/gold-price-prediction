<?php

namespace App\Support\Ui\Styles;

use App\Enums\Ui\BadgeVariant;
use App\Support\Ui\ClassBuilder;

class BadgeStyle
{
    public static function make(
        BadgeVariant $variant,
    ): string {
        return (new ClassBuilder())
            ->add(self::base())
            ->add(self::variant($variant))
            ->build();
    }

    protected static function base(): string
    {
        return implode(' ', [
            'inline-flex',
            'items-center',
            'justify-center',

            'rounded-pill',

            'px-3',
            'py-1',

            'text-xs',
            'font-medium',

            'whitespace-nowrap',
        ]);
    }

    protected static function variant(BadgeVariant $variant): string
    {
        return match ($variant) {

            BadgeVariant::Primary => implode(' ', [
                'bg-primary-light',
                'text-primary',
            ]),

            BadgeVariant::Success => implode(' ', [
                'bg-success-light',
                'text-success',
            ]),

            BadgeVariant::Warning => implode(' ', [
                'bg-warning-light',
                'text-warning',
            ]),

            BadgeVariant::Danger => implode(' ', [
                'bg-danger-light',
                'text-danger',
            ]),

            BadgeVariant::Info => implode(' ', [
                'bg-info-light',
                'text-info',
            ]),

            BadgeVariant::Secondary => implode(' ', [
                'bg-gray-100',
                'text-gray-700',
            ]),
        };
    }
}