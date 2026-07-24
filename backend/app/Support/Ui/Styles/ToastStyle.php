<?php

namespace App\Support\Ui\Styles;

use App\Enums\Ui\ToastVariant;
use App\Support\Ui\ClassBuilder;

class ToastStyle
{
    public function container(ToastVariant $variant): string
    {
        return ClassBuilder::make()
            ->add('flex items-center gap-3')
            ->add('rounded-lg')
            ->add('shadow-lg')
            ->add('px-4 py-3')
            ->add('min-w-80')
            ->add(match ($variant) {

                ToastVariant::Success =>
                    'bg-green-600 text-white',

                ToastVariant::Error =>
                    'bg-red-600 text-white',

                ToastVariant::Warning =>
                    'bg-yellow-500 text-black',

                ToastVariant::Info =>
                    'bg-blue-600 text-white',
            })
            ->build();
    }
}