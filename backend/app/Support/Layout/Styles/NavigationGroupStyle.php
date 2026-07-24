<?php

declare(strict_types=1);

namespace App\Support\Layout\Styles;

use App\Support\Ui\BaseStyle;

final class NavigationGroupStyle extends BaseStyle
{
    public function wrapper(): string
    {
        return $this->builder()
            ->add('space-y-2')
            ->build();
    }

    public function title(): string
    {
        return $this->builder()
            ->addMany([
                'px-3',
                'text-xs',
                'font-semibold',
                'uppercase',
                'tracking-wider',
                'text-secondary',
            ])
            ->build();
    }

    public function items(): string
    {
        return $this->builder()
            ->add('space-y-1')
            ->build();
    }
}