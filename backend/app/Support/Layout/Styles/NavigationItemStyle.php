<?php

declare(strict_types=1);

namespace App\Support\Layout\Styles;

use App\Support\Ui\ClassBuilder;
use App\Support\Ui\BaseStyle;

class NavigationItemStyle extends BaseStyle
{
    public function link(bool $active = false): string
    {
        return $this->builder()
            ->add('flex items-center gap-3')
            ->add('rounded-lg')
            ->add('px-3 py-2')
            ->add('transition-colors')
            ->add($active
                ? 'bg-primary text-white'
                : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800')
            ->build();
    }

    public function icon(): string
    {
        return $this->builder()
            ->add('h-5 w-5')
            ->build();
    }

    public function label(): string
    {
        return $this->builder()
            ->add('flex-1')
            ->build();
    }
}