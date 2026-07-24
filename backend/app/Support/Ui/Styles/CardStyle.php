<?php

namespace App\Support\Ui\Styles;

use App\Enums\Ui\CardVariant;
use App\Support\Ui\ClassBuilder;

class CardStyle
{
    public static function make(
        CardVariant $variant,
    ): string {
        return (new ClassBuilder())
            ->add(self::base())
            ->add(self::variant($variant))
            ->build();
    }

    protected static function base(): string
    {
        return implode(' ', [
            'rounded-card',
            'overflow-hidden',
            'transition-all',
            'duration-normal',
        ]);
    }
    
    protected static function variant(CardVariant $variant): string
    {
        return match ($variant) {

            CardVariant::Default => implode(' ', [
                'bg-card',
                'border',
                'border-border',
            ]),

            CardVariant::Outlined => implode(' ', [
                'bg-transparent',
                'border',
                'border-border',
            ]),

            CardVariant::Elevated => implode(' ', [
                'bg-card',
                'shadow-card',
            ]),

            CardVariant::Flat => 'bg-card',
        };
    }
}