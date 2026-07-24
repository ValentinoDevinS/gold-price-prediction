<?php

declare(strict_types=1);

namespace App\Support\Layout\Styles;

use App\Support\Ui\BaseStyle;

final class PageContentStyle extends BaseStyle
{
    public function wrapper(): string
    {
        return $this->builder()
            ->addMany([
                'flex-1',
                'overflow-y-auto',
                'bg-surface-secondary',
            ])
            ->build();
    }

    public function content(): string
    {
        return $this->builder()
            ->addMany([
                'mx-auto',
                'w-full',
                'max-w-7xl',
                'p-6',
            ])
            ->build();
    }
}