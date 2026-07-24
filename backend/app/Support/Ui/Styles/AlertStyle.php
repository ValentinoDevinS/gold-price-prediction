<?php

namespace App\Support\Ui\Styles;

use App\Enums\Ui\AlertVariant;
use App\Support\Ui\ClassBuilder;

class AlertStyle
{
    public function container(AlertVariant $variant): string
    {
        return ClassBuilder::make()
            ->add('rounded-lg')
            ->add('border')
            ->add('px-4 py-3')
            ->add(match ($variant) {

                AlertVariant::Success =>
                    'border-green-200 bg-green-50 text-green-800',

                AlertVariant::Error =>
                    'border-red-200 bg-red-50 text-red-800',

                AlertVariant::Warning =>
                    'border-yellow-200 bg-yellow-50 text-yellow-800',

                AlertVariant::Info =>
                    'border-blue-200 bg-blue-50 text-blue-800',
            })
            ->build();
    }
}