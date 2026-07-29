<?php

declare(strict_types=1);

namespace App\DTOs\Table;

use Closure;

final class TableColumn
{
    private function __construct(
        public readonly string $key,
        public readonly string $label = '',
        public readonly bool $sortable = false,
        public readonly bool $searchable = false,
        public readonly bool $visible = true,
        public readonly string $align = 'left',
        public readonly ?string $width = null,
        public readonly ?string $type = null,
        public readonly ?Closure $formatter = null,
    ) {
    }

    public static function make(string $key): self
    {
        return new self(key: $key);
    }

    public function label(string $label): self
    {
        return new self(
            key: $this->key,
            label: $label,
            sortable: $this->sortable,
            searchable: $this->searchable,
            visible: $this->visible,
            align: $this->align,
            width: $this->width,
            type: $this->type,
            formatter: $this->formatter,
        );
    }

    public function sortable(bool $state = true): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            sortable: $state,
            searchable: $this->searchable,
            visible: $this->visible,
            align: $this->align,
            width: $this->width,
            type: $this->type,
            formatter: $this->formatter,
        );
    }

    public function searchable(bool $state = true): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            sortable: $this->sortable,
            searchable: $state,
            visible: $this->visible,
            align: $this->align,
            width: $this->width,
            type: $this->type,
            formatter: $this->formatter,
        );
    }

    public function hidden(): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            sortable: $this->sortable,
            searchable: $this->searchable,
            visible: false,
            align: $this->align,
            width: $this->width,
            type: $this->type,
            formatter: $this->formatter,
        );
    }

    public function alignLeft(): self
    {
        return $this->align('left');
    }

    public function alignCenter(): self
    {
        return $this->align('center');
    }

    public function alignRight(): self
    {
        return $this->align('right');
    }

    public function align(string $align): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            sortable: $this->sortable,
            searchable: $this->searchable,
            visible: $this->visible,
            align: $align,
            width: $this->width,
            type: $this->type,
            formatter: $this->formatter,
        );
    }

    public function width(string $width): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            sortable: $this->sortable,
            searchable: $this->searchable,
            visible: $this->visible,
            align: $this->align,
            width: $width,
            type: $this->type,
            formatter: $this->formatter,
        );
    }

    public function text(): self
    {
        return $this->type('text');
    }

    public function numeric(): self
    {
        return $this->type('numeric')
            ->alignRight();
    }

    public function date(): self
    {
        return $this->type('date');
    }

    public function badge(): self
    {
        return $this->type('badge');
    }

    public function type(string $type): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            sortable: $this->sortable,
            searchable: $this->searchable,
            visible: $this->visible,
            align: $this->align,
            width: $this->width,
            type: $type,
            formatter: $this->formatter,
        );
    }

    public function format(Closure $formatter): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            sortable: $this->sortable,
            searchable: $this->searchable,
            visible: $this->visible,
            align: $this->align,
            width: $this->width,
            type: $this->type,
            formatter: $formatter,
        );
    }
}