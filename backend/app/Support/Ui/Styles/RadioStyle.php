<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

use App\Support\Ui\BaseStyle;

final class RadioStyle extends BaseStyle
{
    public function wrapper(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'items-start',
                'gap-3',
            ])
            ->build();
    }

    public function radio(): string
    {
        return $this->builder()
            ->addMany([
                'mt-0.5',
                'h-4',
                'w-4',
                'border-gray-300',
                'text-indigo-600',
                'shadow-sm',
                'focus:ring-2',
                'focus:ring-indigo-500',
                'disabled:cursor-not-allowed',
                'disabled:opacity-60',
                'dark:border-gray-600',
                'dark:bg-gray-800',
            ])
            ->build();
    }

    public function label(): string
    {
        return $this->builder()
            ->addMany([
                'text-sm',
                'font-medium',
                'text-gray-700',
                'dark:text-gray-300',
            ])
            ->build();
    }

    public function helper(): string
    {
        return $this->builder()
            ->addMany([
                'mt-1',
                'text-sm',
                'text-gray-500',
                'dark:text-gray-400',
            ])
            ->build();
    }

    public function error(): string
    {
        return $this->builder()
            ->addMany([
                'mt-1',
                'text-sm',
                'font-medium',
                'text-red-600',
                'dark:text-red-400',
            ])
            ->build();
    }
}