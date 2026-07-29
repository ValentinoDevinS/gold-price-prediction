<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

use App\Support\Ui\BaseStyle;

final class DropdownStyle extends BaseStyle
{
    public function trigger(): string
    {
        return $this->builder()
            ->addMany([
                'inline-flex',
                'items-center',
                'justify-center',
                'gap-2',
                'rounded-lg',
                'transition-colors',
                'focus:outline-none',
                'focus:ring-2',
                'focus:ring-indigo-500',
            ])
            ->build();
    }

    public function menu(): string
    {
        return $this->builder()
            ->addMany([
                'absolute',
                'right-0',
                'z-50',
                'mt-2',
                'min-w-56',
                'overflow-hidden',
                'rounded-lg',
                'border',
                'border-gray-200',
                'bg-white',
                'shadow-lg',
                'dark:border-gray-700',
                'dark:bg-gray-800',
            ])
            ->build();
    }

    public function header(): string
    {
        return $this->builder()
            ->addMany([
                'border-b',
                'border-gray-200',
                'px-4',
                'py-3',
                'dark:border-gray-700',
            ])
            ->build();
    }

    public function content(): string
    {
        return $this->builder()
            ->addMany([
                'py-2',
            ])
            ->build();
    }

    public function item(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'w-full',
                'items-center',
                'gap-3',
                'px-4',
                'py-2',
                'text-sm',
                'text-gray-700',
                'transition-colors',
                'hover:bg-gray-100',
                'dark:text-gray-200',
                'dark:hover:bg-gray-700',
            ])
            ->build();
    }

    public function icon(): string
    {
        return $this->builder()
            ->addMany([
                'h-4',
                'w-4',
                'shrink-0',
                'flex',
                'items-center',
                'justify-center',
            ])
            ->build();
    }

    /**
     * Width reserved for the checkmark so all items align.
     */
    public function checkmark(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'h-4',
                'w-4',
                'shrink-0',
                'items-center',
                'justify-center',
                'text-indigo-600',
            ])
            ->build();
    }

    public function divider(): string
    {
        return $this->builder()
            ->addMany([
                'my-2',
                'border-t',
                'border-gray-200',
                'dark:border-gray-700',
            ])
            ->build();
    }

    public function footer(): string
    {
        return $this->builder()
            ->addMany([
                'border-t',
                'border-gray-200',
                'px-4',
                'py-3',
                'dark:border-gray-700',
            ])
            ->build();
    }
}