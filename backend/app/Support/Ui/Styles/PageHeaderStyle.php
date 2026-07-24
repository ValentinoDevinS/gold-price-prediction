<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

use App\Support\Ui\BaseStyle;

final class PageHeaderStyle extends BaseStyle
{
    public function wrapper(): string
    {
        return $this->builder()
            ->addMany([
                'mb-8',
                'flex',
                'flex-col',
                'gap-4',
                'md:flex-row',
                'md:items-start',
                'md:justify-between',
            ])
            ->build();
    }

    public function content(): string
    {
        return $this->builder()
            ->addMany([
                'min-w-0',
                'flex-1',
            ])
            ->build();
    }

    public function breadcrumb(): string
    {
        return $this->builder()
            ->addMany([
                'mb-2',
            ])
            ->build();
    }

    public function title(): string
    {
        return $this->builder()
            ->addMany([
                'text-3xl',
                'font-bold',
                'tracking-tight',
                'text-gray-900',
                'dark:text-white',
            ])
            ->build();
    }

    public function description(): string
    {
        return $this->builder()
            ->addMany([
                'mt-2',
                'max-w-3xl',
                'text-sm',
                'leading-6',
                'text-gray-500',
                'dark:text-gray-400',
            ])
            ->build();
    }

    public function actions(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'flex-wrap',
                'items-center',
                'justify-end',
                'gap-3',
                'shrink-0',
            ])
            ->build();
    }
}