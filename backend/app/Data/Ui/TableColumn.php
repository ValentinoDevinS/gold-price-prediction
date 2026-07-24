<?php

namespace App\Data\Ui;

use App\Enums\Ui\TableAlignment;

readonly class TableColumn
{
    public function __construct(
        public string $key,

        public string $label,

        public bool $sortable = false,

        public bool $searchable = false,

        public bool $hidden = false,

        public bool $toggleable = true,

        public ?string $width = null,

        public TableAlignment $alignment = TableAlignment::Left,
    ) {}

    public static function make(
        string $key,
        string $label,
    ): self {
        return new self(
            key: $key,
            label: $label,
        );
    }

    public function sortable(bool $sortable = true): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            sortable: $sortable,
            searchable: $this->searchable,
            hidden: $this->hidden,
            toggleable: $this->toggleable,
            width: $this->width,
            alignment: $this->alignment,
        );
    }

    public function searchable(bool $searchable = true): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            sortable: $this->sortable,
            searchable: $searchable,
            hidden: $this->hidden,
            toggleable: $this->toggleable,
            width: $this->width,
            alignment: $this->alignment,
        );
    }

    public function hidden(bool $hidden = true): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            sortable: $this->sortable,
            searchable: $this->searchable,
            hidden: $hidden,
            toggleable: $this->toggleable,
            width: $this->width,
            alignment: $this->alignment,
        );
    }

    public function toggleable(bool $toggleable = true): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            sortable: $this->sortable,
            searchable: $this->searchable,
            hidden: $this->hidden,
            toggleable: $toggleable,
            width: $this->width,
            alignment: $this->alignment,
        );
    }

    public function width(string $width): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            sortable: $this->sortable,
            searchable: $this->searchable,
            hidden: $this->hidden,
            toggleable: $this->toggleable,
            width: $width,
            alignment: $this->alignment,
        );
    }

    public function alignment(TableAlignment $alignment): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            sortable: $this->sortable,
            searchable: $this->searchable,
            hidden: $this->hidden,
            toggleable: $this->toggleable,
            width: $this->width,
            alignment: $alignment,
        );
    }
}