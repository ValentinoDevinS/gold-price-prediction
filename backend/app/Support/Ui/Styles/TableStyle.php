<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

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

    public function responsive(): string
    {
        return $this->builder()
            ->addMany([
                'overflow-x-auto',
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

    public function head(): string
    {
        return $this->builder()
            ->addMany([
                'bg-gray-50',
                'dark:bg-gray-900',
            ])
            ->build();
    }

    public function headRow(): string
    {
        return '';
    }

    public function headCell(): string
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

    public function body(): string
    {
        return $this->builder()
            ->build();
    }

    public function row(): string
    {
        return $this->builder()
            ->addMany([
                'border-b',
                'border-gray-200',
                'transition-colors',
                'hover:bg-gray-50',
                'dark:border-gray-700',
                'dark:hover:bg-gray-700/50',
            ])
            ->build();
    }

    public function cell(): string
    {
        return $this->builder()
            ->addMany([
                'whitespace-nowrap',
                'px-6',
                'py-4',
                'text-sm',
                'text-gray-700',
                'dark:text-gray-300',
            ])
            ->build();
    }

    public function checkbox(): string
    {
        return $this->builder()
            ->addMany([
                'h-4',
                'w-4',
                'rounded',
                'border-gray-300',
                'text-indigo-600',
                'focus:ring-indigo-500',
            ])
            ->build();
    }

    public function actions(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'justify-end',
                'gap-2',
            ])
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

    public function loadingState(): string
    {
        return $this->builder()
            ->addMany([
                'px-6',
                'py-8',
            ])
            ->build();
    }

    public function footer(): string
    {
        return $this->builder()
            ->addMany([
                'border-t',
                'border-gray-200',
                'bg-gray-50',
                'px-6',
                'py-4',
                'dark:border-gray-700',
                'dark:bg-gray-900',
            ])
            ->build();
    }

    public function pagination(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'items-center',
                'justify-between',
            ])
            ->build();
    }
}