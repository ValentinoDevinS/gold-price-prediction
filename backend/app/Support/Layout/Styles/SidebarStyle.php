<?php

namespace App\Support\Layout\Styles;

use App\Support\Ui\ClassBuilder;

class SidebarStyle
{
    public function wrapper(): string
    {
        return ClassBuilder::make()
            ->add('flex')
            ->add('h-screen')
            ->add('w-72')
            ->add('flex-col')
            ->add('border-r')
            ->add('border-gray-200')
            ->add('bg-white')
            ->add('dark:border-gray-800')
            ->add('dark:bg-gray-900')
            ->build();
    }

    public function header(): string
    {
        return ClassBuilder::make()
            ->add('border-b')
            ->add('border-gray-200')
            ->add('px-6')
            ->add('py-5')
            ->build();
    }

    public function content(): string
    {
        return ClassBuilder::make()
            ->add('flex-1')
            ->add('space-y-6')
            ->add('overflow-y-auto')
            ->add('p-4')
            ->build();
    }

    public function footer(): string
    {
        return ClassBuilder::make()
            ->add('border-t')
            ->add('border-gray-200')
            ->add('p-4')
            ->build();
    }
}