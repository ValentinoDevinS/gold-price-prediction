<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

use App\Support\Ui\BaseStyle;

final class BreadcrumbStyle extends BaseStyle
{
    public function wrapper(): string
    {
        return $this->builder()
            ->addMany([
                'w-full',
            ])
            ->build();
    }

    public function list(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'flex-wrap',
                'items-center',
                'gap-2',
                'text-sm',
            ])
            ->build();
    }

    public function item(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'items-center',
                'gap-2',
            ])
            ->build();
    }

    public function link(): string
    {
        return $this->builder()
            ->addMany([
                'text-gray-500',
                'transition-colors',
                'hover:text-indigo-600',
                'dark:text-gray-400',
                'dark:hover:text-indigo-400',
            ])
            ->build();
    }

    public function separator(): string
    {
        return $this->builder()
            ->addMany([
                'h-4',
                'w-4',
                'text-gray-400',
                'shrink-0',
            ])
            ->build();
    }

    public function current(): string
    {
        return $this->builder()
            ->addMany([
                'font-medium',
                'text-gray-900',
                'dark:text-white',
            ])
            ->build();
    }
}