<?php

namespace App\Support\Ui\Styles;

use App\Support\Ui\ClassBuilder;

class DropdownStyle
{
    public function wrapper(): string
    {
        return ClassBuilder::make()
            ->add('relative')
            ->add('inline-block')
            ->build();
    }

    public function menu(): string
    {
        return ClassBuilder::make()
            ->add('absolute')
            ->add('right-0')
            ->add('mt-2')
            ->add('min-w-48')
            ->add('overflow-hidden')
            ->add('rounded-lg')
            ->add('border')
            ->add('border-border')
            ->add('bg-background')
            ->add('shadow-lg')
            ->add('z-50')
            ->build();
    }

    public function item(): string
    {
        return ClassBuilder::make()
            ->add('flex')
            ->add('items-center')
            ->add('gap-2')
            ->add('px-4')
            ->add('py-2')
            ->add('cursor-pointer')
            ->add('transition-colors')
            ->add('hover:bg-muted')
            ->build();
    }

    public function checkmark(): string
    {
        return ClassBuilder::make()
            ->add('w-5')
            ->add('text-center')
            ->add('text-primary')
            ->build();
    }
}