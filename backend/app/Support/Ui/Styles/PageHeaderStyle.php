<?php

namespace App\Support\Ui\Styles;

use App\Support\Ui\ClassBuilder;

class PageHeaderStyle
{
    public function wrapper(): string
    {
        return ClassBuilder::make()
            ->add('flex')
            ->add('items-start')
            ->add('justify-between')
            ->add('gap-6')
            ->add('mb-6')
            ->build();
    }

    public function content(): string
    {
        return ClassBuilder::make()
            ->add('flex-1')
            ->build();
    }

    public function title(): string
    {
        return ClassBuilder::make()
            ->add('text-3xl')
            ->add('font-bold')
            ->add('text-gray-900')
            ->add('dark:text-gray-100')
            ->build();
    }

    public function description(): string
    {
        return ClassBuilder::make()
            ->add('mt-2')
            ->add('text-gray-600')
            ->add('dark:text-gray-400')
            ->build();
    }

    public function actions(): string
    {
        return ClassBuilder::make()
            ->add('flex')
            ->add('items-center')
            ->add('gap-3')
            ->build();
    }
}