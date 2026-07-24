<?php

namespace App\Support\Layout\Styles;

use App\Support\Ui\ClassBuilder;

class PageContentStyle
{
    public function wrapper(): string
    {
        return ClassBuilder::make()
            ->add('flex-1')
            ->add('overflow-y-auto')
            ->add('bg-gray-50')
            ->add('dark:bg-gray-950')
            ->build();
    }

    public function content(): string
    {
        return ClassBuilder::make()
            ->add('mx-auto')
            ->add('w-full')
            ->add('max-w-7xl')
            ->add('p-6')
            ->build();
    }
}