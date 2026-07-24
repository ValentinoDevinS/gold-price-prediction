<?php

namespace App\Support\Layout\Styles;

use App\Support\Ui\ClassBuilder;

class NavigationGroupStyle
{
    public function wrapper(): string
    {
        return ClassBuilder::make()
            ->add('space-y-2')
            ->build();
    }

    public function title(): string
    {
        return ClassBuilder::make()
            ->add('px-3')
            ->add('text-xs')
            ->add('font-semibold')
            ->add('uppercase')
            ->add('tracking-wider')
            ->add('text-gray-500')
            ->build();
    }

    public function items(): string
    {
        return ClassBuilder::make()
            ->add('space-y-1')
            ->build();
    }
}