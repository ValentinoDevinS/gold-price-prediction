<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

use App\Support\Ui\BaseStyle;

final class InputStyle extends BaseStyle
{
    public function wrapper(): string
    {
        return $this->builder()
            ->addMany([
                'space-y-2',
            ])
            ->build();
    }

    public function label(): string
    {
        return $this->builder()
            ->addMany([
                'block',
                'text-sm',
                'font-medium',
                'text-gray-700',
                'dark:text-gray-300',
            ])
            ->build();
    }

    public function input(): string
    {
        return $this->builder()
            ->addMany([
                'block',
                'w-full',
                'rounded-lg',
                'border',
                'border-gray-300',
                'bg-white',
                'px-3',
                'py-2',
                'text-sm',
                'text-gray-900',
                'placeholder:text-gray-400',
                'shadow-sm',
                'transition-colors',
                'focus:border-indigo-500',
                'focus:outline-none',
                'focus:ring-2',
                'focus:ring-indigo-500',
                'disabled:cursor-not-allowed',
                'disabled:bg-gray-100',
                'disabled:opacity-60',
                'dark:border-gray-600',
                'dark:bg-gray-800',
                'dark:text-white',
                'dark:placeholder:text-gray-500',
            ])
            ->build();
    }

    public function icon(): string
    {
        return $this->builder()
            ->addMany([
                'h-5',
                'w-5',
                'text-gray-400',
            ])
            ->build();
    }

    public function helper(): string
    {
        return $this->builder()
            ->addMany([
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
                'text-sm',
                'font-medium',
                'text-red-600',
                'dark:text-red-400',
            ])
            ->build();
    }
}