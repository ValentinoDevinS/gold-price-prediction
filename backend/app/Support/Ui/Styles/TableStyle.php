<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

use App\Enums\Ui\TableAlignment;
use App\Support\Ui\BaseStyle;

final class TableStyle extends BaseStyle
{
    public function wrapper(): string
    {
        return $this->builder()
            ->addMany([
                'overflow-hidden',
                'rounded-xl',
                'border',
                'border-gray-200',
                'bg-white',
                'shadow-sm',
                'dark:border-gray-700',
                'dark:bg-gray-800',
            ])
            ->build();
    }

    public function toolbar(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'items-center',
                'justify-between',
                'gap-4',
                'border-b',
                'border-gray-200',
                'p-4',
                'dark:border-gray-700',
            ])
            ->build();
    }

    public function table(): string
    {
        return $this->builder()
            ->addMany([
                'min-w-full',
                'divide-y',
                'divide-gray-200',
                'dark:divide-gray-700',
            ])
            ->build();
    }

    public function header(): string
    {
        return $this->builder()
            ->addMany([
                'bg-gray-50',
                'dark:bg-gray-900',
            ])
            ->build();
    }

    public function headerCell(): string
    {
        return $this->builder()
            ->addMany([
                'px-6',
                'py-3',
                'text-left',
                'text-xs',
                'font-semibold',
                'uppercase',
                'tracking-wider',
                'text-gray-500',
                'dark:text-gray-400',
            ])
            ->build();
    }

    public function row(): string
    {
        return $this->builder()
            ->addMany([
                'border-b',
                'border-gray-200',
                'hover:bg-gray-50',
                'dark:border-gray-700',
                'dark:hover:bg-gray-700/50',
            ])
            ->build();
    }

    public function cell(
        ?TableAlignment $alignment = null,
    ): string {

        $classes = [
            'whitespace-nowrap',
            'px-6',
            'py-4',
            'text-sm',
            'text-gray-700',
            'dark:text-gray-300',
        ];

        if ($alignment === TableAlignment::Right) {
            $classes[] = 'text-right';
        } elseif ($alignment === TableAlignment::Center) {
            $classes[] = 'text-center';
        } else {
            $classes[] = 'text-left';
        }

        return $this->builder()
            ->addMany($classes)
            ->build();
    }

    public function emptyState(): string
    {
        return $this->builder()
            ->addMany([
                'px-6',
                'py-16',
                'text-center',
                'text-gray-500',
                'dark:text-gray-400',
            ])
            ->build();
    }

    public function pagination(): string
    {
        return $this->builder()
            ->addMany([
                'border-t',
                'border-gray-200',
                'p-4',
                'dark:border-gray-700',
            ])
            ->build();
    }
}