<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

use App\Support\Ui\BaseStyle;

final class BadgeStyle extends BaseStyle
{
    public function wrapper(): string
    {
        return $this->builder()
            ->addMany([
                'inline-flex',
                'items-center',
                'gap-1.5',
                'rounded-full',
                'px-2.5',
                'py-1',
                'text-xs',
                'font-medium',
                'whitespace-nowrap',
            ])
            ->build();
    }

    public function icon(): string
    {
        return $this->builder()
            ->addMany([
                'h-3.5',
                'w-3.5',
                'shrink-0',
            ])
            ->build();
    }

    public function label(): string
    {
        return $this->builder()
            ->addMany([
                'leading-none',
            ])
            ->build();
    }
}