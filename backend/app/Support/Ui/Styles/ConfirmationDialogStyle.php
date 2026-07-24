<?php

namespace App\Support\Ui\Styles;

use App\Enums\Ui\ConfirmationVariant;
use App\Support\Ui\ClassBuilder;

class ConfirmationDialogStyle
{
    public function icon(ConfirmationVariant $variant): string
    {
        return ClassBuilder::make()
            ->add('mx-auto mb-4')
            ->add('flex h-12 w-12 items-center justify-center')
            ->add('rounded-full')
            ->add(match ($variant) {

                ConfirmationVariant::Default =>
                    'bg-blue-100 text-blue-600',

                ConfirmationVariant::Danger =>
                    'bg-red-100 text-red-600',

            })
            ->build();
    }

    public function message(): string
    {
        return ClassBuilder::make()
            ->add('text-center')
            ->add('text-gray-600')
            ->build();
    }
}