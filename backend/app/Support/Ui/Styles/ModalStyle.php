<?php

namespace App\Support\Ui\Styles;

use App\Support\Ui\ClassBuilder;

class ModalStyle
{
    public function overlay(): string
    {
        return ClassBuilder::make()
            ->add('fixed inset-0 z-50')
            ->add('flex items-center justify-center')
            ->add('bg-black/50')
            ->build();
    }

    public function container(): string
    {
        return ClassBuilder::make()
            ->add('w-full max-w-2xl')
            ->add('rounded-xl')
            ->add('bg-white')
            ->add('shadow-xl')
            ->add('dark:bg-gray-800')
            ->build();
    }

    public function header(): string
    {
        return ClassBuilder::make()
            ->add('flex items-center justify-between')
            ->add('border-b')
            ->add('px-6 py-4')
            ->build();
    }

    public function title(): string
    {
        return ClassBuilder::make()
            ->add('text-lg')
            ->add('font-semibold')
            ->build();
    }

    public function body(): string
    {
        return ClassBuilder::make()
            ->add('p-6')
            ->build();
    }

    public function footer(): string
    {
        return ClassBuilder::make()
            ->add('flex justify-end gap-3')
            ->add('border-t')
            ->add('px-6 py-4')
            ->build();
    }
}