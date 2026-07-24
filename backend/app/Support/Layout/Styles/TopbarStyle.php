<?php

declare(strict_types=1);

namespace App\Support\Layout\Styles;

use App\Support\Ui\BaseStyle;

final class TopbarStyle extends BaseStyle
{
    public function wrapper(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'h-16',
                'items-center',
                'justify-between',
                'border-b',
                'border-border',
                'bg-surface',
                'px-6',
                'gap-4',
            ])
            ->build();
    }

    public function section(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'flex-1',
                'items-center',
                'gap-4',
            ])
            ->build();
    }

    public function title(): string
    {
        return $this->builder()
            ->addMany([
                'text-lg',
                'font-semibold',
                'text-primary',
            ])
            ->build();
    }

    public function actions(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'items-center',
                'gap-2',
            ])
            ->build();
    }
}