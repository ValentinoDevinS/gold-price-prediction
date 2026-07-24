<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

use App\Support\Ui\BaseStyle;

final class StatCardStyle extends BaseStyle
{
    public function wrapper(): string
    {
        return $this->builder()
            ->addMany([
                'rounded-xl',
                'border',
                'border-gray-200',
                'bg-white',
                'shadow-sm',
                'p-6',
                'dark:border-gray-700',
                'dark:bg-gray-800',
            ])
            ->build();
    }

    public function header(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'items-start',
                'justify-between',
                'gap-4',
            ])
            ->build();
    }

    public function icon(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'h-10',
                'w-10',
                'items-center',
                'justify-center',
                'rounded-lg',
                'bg-gray-100',
                'text-gray-600',
                'dark:bg-gray-700',
                'dark:text-gray-300',
            ])
            ->build();
    }

    public function content(): string
    {
        return $this->builder()
            ->addMany([
                'mt-4',
                'space-y-1',
            ])
            ->build();
    }

    public function title(): string
    {
        return $this->builder()
            ->addMany([
                'text-sm',
                'font-medium',
                'text-gray-500',
                'dark:text-gray-400',
            ])
            ->build();
    }

    public function value(): string
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
                'text-sm',
                'text-gray-500',
                'dark:text-gray-400',
            ])
            ->build();
    }

    public function footer(): string
    {
        return $this->builder()
            ->addMany([
                'mt-5',
                'flex',
                'items-center',
                'justify-between',
                'border-t',
                'border-gray-200',
                'pt-4',
                'dark:border-gray-700',
            ])
            ->build();
    }

    public function trend(): string
    {
        return $this->builder()
            ->addMany([
                'inline-flex',
                'items-center',
                'gap-1',
                'text-sm',
                'font-medium',
            ])
            ->build();
    }
}