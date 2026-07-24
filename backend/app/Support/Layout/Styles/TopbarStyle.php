<?php

namespace App\Support\Layout\Styles;

use App\Support\Ui\ClassBuilder;

class TopbarStyle
{
    public function wrapper(): string
    {
        return ClassBuilder::make()
            ->add('flex')
            ->add('h-16')
            ->add('items-center')
            ->add('justify-between')
            ->add('border-b')
            ->add('border-gray-200')
            ->add('bg-white')
            ->add('px-6')
            ->add('dark:border-gray-800')
            ->add('dark:bg-gray-900')
            ->build();
    }

    public function section(): string
    {
        return ClassBuilder::make()
            ->add('flex')
            ->add('items-center')
            ->add('gap-3')
            ->build();
    }
}