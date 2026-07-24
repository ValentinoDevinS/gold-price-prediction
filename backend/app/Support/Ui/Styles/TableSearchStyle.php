<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

use App\Support\Ui\BaseStyle;

final class TableSearchStyle extends BaseStyle
{
    public function wrapper(): string
    {
        return $this->builder()
            ->addMany([
                'mb-6',
                'flex',
                'flex-col',
                'gap-4',
                'lg:flex-row',
                'lg:items-center',
                'lg:justify-between',
            ])
            ->build();
    }

    public function left(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'flex-1',
                'flex-wrap',
                'items-center',
                'gap-3',
            ])
            ->build();
    }

    public function right(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'flex-wrap',
                'items-center',
                'justify-end',
                'gap-3',
            ])
            ->build();
    }

    public function search(): string
    {
        return $this->builder()
            ->addMany([
                'w-full',
                'max-w-md',
            ])
            ->build();
    }

    public function filters(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'flex-wrap',
                'items-center',
                'gap-2',
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
                'gap-2',
            ])
            ->build();
    }

    public function buttonGroup(): string
    {
        return $this->builder()
            ->addMany([
                'inline-flex',
                'items-center',
                'rounded-lg',
                'border',
                'border-gray-200',
                'bg-white',
                'shadow-sm',
                'dark:border-gray-700',
                'dark:bg-gray-800',
            ])
            ->build();
    }
}