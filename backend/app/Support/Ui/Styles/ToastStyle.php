<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

use App\Support\Ui\BaseStyle;

final class ToastStyle extends BaseStyle
{
    public function wrapper(): string
    {
        return $this->builder()
            ->addMany([
                'pointer-events-auto',
                'relative',
                'flex',
                'w-full',
                'max-w-sm',
                'items-start',
                'gap-3',
                'overflow-hidden',
                'rounded-lg',
                'border',
                'bg-white',
                'p-4',
                'shadow-lg',
                'dark:border-gray-700',
                'dark:bg-gray-800',
            ])
            ->build();
    }

    public function icon(): string
    {
        return $this->builder()
            ->addMany([
                'mt-0.5',
                'h-5',
                'w-5',
                'shrink-0',
            ])
            ->build();
    }

    public function content(): string
    {
        return $this->builder()
            ->addMany([
                'flex-1',
                'min-w-0',
            ])
            ->build();
    }

    public function title(): string
    {
        return $this->builder()
            ->addMany([
                'text-sm',
                'font-semibold',
                'text-gray-900',
                'dark:text-white',
            ])
            ->build();
    }

    public function description(): string
    {
        return $this->builder()
            ->addMany([
                'mt-1',
                'text-sm',
                'leading-5',
                'text-gray-600',
                'dark:text-gray-300',
            ])
            ->build();
    }

    public function actions(): string
    {
        return $this->builder()
            ->addMany([
                'mt-3',
                'flex',
                'items-center',
                'gap-2',
            ])
            ->build();
    }

    public function closeButton(): string
    {
        return $this->builder()
            ->addMany([
                'ml-auto',
                'inline-flex',
                'h-8',
                'w-8',
                'items-center',
                'justify-center',
                'rounded-md',
                'transition-colors',
                'hover:bg-gray-100',
                'focus:outline-none',
                'focus:ring-2',
                'focus:ring-indigo-500',
                'dark:hover:bg-gray-700',
            ])
            ->build();
    }

    public function progress(): string
    {
        return $this->builder()
            ->addMany([
                'absolute',
                'bottom-0',
                'left-0',
                'h-1',
                'w-full',
                'origin-left',
            ])
            ->build();
    }
}