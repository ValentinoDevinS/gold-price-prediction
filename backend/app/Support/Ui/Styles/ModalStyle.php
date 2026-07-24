<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

use App\Support\Ui\BaseStyle;

final class ModalStyle extends BaseStyle
{
    public function overlay(): string
    {
        return $this->builder()
            ->addMany([
                'fixed',
                'inset-0',
                'z-50',
                'flex',
                'items-center',
                'justify-center',
                'bg-black/50',
                'backdrop-blur-sm',
                'p-4',
            ])
            ->build();
    }

    public function container(): string
    {
        return $this->builder()
            ->addMany([
                'relative',
                'w-full',
                'max-w-2xl',
                'overflow-hidden',
                'rounded-xl',
                'bg-white',
                'shadow-2xl',
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
                'border-b',
                'border-gray-200',
                'px-6',
                'py-4',
                'dark:border-gray-700',
            ])
            ->build();
    }

    public function title(): string
    {
        return $this->builder()
            ->addMany([
                'text-lg',
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
                'text-gray-500',
                'dark:text-gray-400',
            ])
            ->build();
    }

    public function body(): string
    {
        return $this->builder()
            ->addMany([
                'max-h-[70vh]',
                'overflow-y-auto',
                'px-6',
                'py-5',
            ])
            ->build();
    }

    public function footer(): string
    {
        return $this->builder()
            ->addMany([
                'border-t',
                'border-gray-200',
                'px-6',
                'py-4',
                'dark:border-gray-700',
            ])
            ->build();
    }

    public function actions(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'justify-end',
                'gap-3',
            ])
            ->build();
    }

    public function closeButton(): string
    {
        return $this->builder()
            ->addMany([
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
}