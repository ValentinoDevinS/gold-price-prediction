<?php

namespace App\Support\Ui\Styles;

use App\Support\Ui\ClassBuilder;

class StatCardStyle
{
    public function wrapper(): string
    {
        return ClassBuilder::make()
            ->add('rounded-xl')
            ->add('border')
            ->add('bg-white')
            ->add('p-6')
            ->add('shadow-sm')
            ->add('dark:border-gray-700')
            ->add('dark:bg-gray-800')
            ->build();
    }

    public function title(): string
    {
        return ClassBuilder::make()
            ->add('text-sm')
            ->add('font-medium')
            ->add('text-gray-500')
            ->add('dark:text-gray-400')
            ->build();
    }

    public function value(): string
    {
        return ClassBuilder::make()
            ->add('mt-2')
            ->add('text-3xl')
            ->add('font-bold')
            ->add('text-gray-900')
            ->add('dark:text-white')
            ->build();
    }

    public function footer(): string
    {
        return ClassBuilder::make()
            ->add('mt-4')
            ->add('text-sm')
            ->add('text-gray-500')
            ->add('dark:text-gray-400')
            ->build();
    }
}