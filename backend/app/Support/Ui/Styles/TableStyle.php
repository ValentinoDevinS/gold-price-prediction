<?php

namespace App\Support\Ui\Styles;

use App\Enums\Ui\TableAlignment;
use App\Enums\Ui\TableDensity;
use App\Support\Ui\ClassBuilder;

class TableStyle
{
    public function __construct(
        protected TableDensity $density = TableDensity::Comfortable,
    ) {
    }

    public function wrapper(): string
    {
        return ClassBuilder::make()
            ->add(
                'relative',
                'overflow-x-auto',
                'rounded-button',
                'border',
                'border-border',
                'bg-surface',
            )
            ->toString();
    }

    public function table(): string
    {
        return ClassBuilder::make()
            ->add(
                'min-w-full',
                'border-collapse',
                'text-left',
            )
            ->toString();
    }

    public function toolbar(): string
    {
        return ClassBuilder::make()
            ->add(
                'flex',
                'items-center',
                'justify-between',
                'gap-4',
                'p-4',
                'border-b',
                'border-border',
                'bg-surface',
                'flex-wrap',
            )
            ->toString();
    }

    public function header(): string
    {
        return ClassBuilder::make()
            ->add(
                'sticky',
                'top-0',
                'z-10',
                'bg-surface-secondary',
                'border-b',
                'border-border',
            )
            ->toString();
    }

    public function headerCell(
        TableAlignment $alignment = TableAlignment::Left,
    ): string {
        return ClassBuilder::make()
            ->add(
                'font-semibold',
                'text-secondary',
                'whitespace-nowrap',
                $this->padding(),
                $this->alignment($alignment),
            )
            ->toString();
    }

    public function row(): string
    {
        return ClassBuilder::make()
            ->add(
                'border-b',
                'border-border',
                'hover:bg-surface-secondary',
                'transition-colors',
            )
            ->toString();
    }

    public function cell(
        TableAlignment $alignment = TableAlignment::Left,
    ): string {
        return ClassBuilder::make()
            ->add(
                $this->padding(),
                $this->alignment($alignment),
                'align-middle',
                'whitespace-nowrap',
            )
            ->toString();
    }

    public function emptyState(): string
    {
        return ClassBuilder::make()
            ->add(
                'py-16',
                'text-center',
                'text-secondary',
            )
            ->toString();
    }

    protected function padding(): string
    {
        return match ($this->density) {

            TableDensity::Compact =>
                'px-3 py-2 text-sm',

            TableDensity::Comfortable =>
                'px-4 py-3',

            TableDensity::Spacious =>
                'px-6 py-4 text-lg',

        };
    }

    protected function alignment(
        TableAlignment $alignment,
    ): string {
        return match ($alignment) {

            TableAlignment::Left =>
                'text-left',

            TableAlignment::Center =>
                'text-center',

            TableAlignment::Right =>
                'text-right',

        };
    }
}