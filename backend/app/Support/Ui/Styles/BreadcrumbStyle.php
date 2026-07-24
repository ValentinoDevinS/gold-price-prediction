<?php

namespace App\Support\Ui\Styles;

use App\Support\Ui\ClassBuilder;

class BreadcrumbStyle
{
    public function container(): string
    {
        return ClassBuilder::make()
            ->add('flex items-center')
            ->add('gap-2')
            ->add('text-sm')
            ->build();
    }

    public function link(): string
    {
        return ClassBuilder::make()
            ->add('text-primary')
            ->add('hover:underline')
            ->build();
    }

    public function current(): string
    {
        return ClassBuilder::make()
            ->add('font-medium')
            ->add('text-gray-900')
            ->add('dark:text-gray-100')
            ->build();
    }

    public function separator(): string
    {
        return ClassBuilder::make()
            ->add('text-gray-400')
            ->build();
    }
}