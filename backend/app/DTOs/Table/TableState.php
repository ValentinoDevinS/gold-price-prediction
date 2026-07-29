<?php

declare(strict_types=1);

namespace App\DTOs\Table;

final class TableState
{
    private function __construct(
        public readonly int $page = 1,
        public readonly int $perPage = 10,
        public readonly ?string $search = null,
        public readonly ?string $sortBy = null,
        public readonly string $sortDirection = 'asc',
        public readonly array $filters = [],
        public readonly array $hiddenColumns = [],
        public readonly string $density = 'comfortable',
    ) {
    }

    public static function make(): self
    {
        return new self();
    }

    public function page(int $page): self
    {
        return new self(
            page: max(1, $page),
            perPage: $this->perPage,
            search: $this->search,
            sortBy: $this->sortBy,
            sortDirection: $this->sortDirection,
            filters: $this->filters,
            hiddenColumns: $this->hiddenColumns,
            density: $this->density,
        );
    }

    public function perPage(int $perPage): self
    {
        return new self(
            page: $this->page,
            perPage: max(1, $perPage),
            search: $this->search,
            sortBy: $this->sortBy,
            sortDirection: $this->sortDirection,
            filters: $this->filters,
            hiddenColumns: $this->hiddenColumns,
            density: $this->density,
        );
    }

    public function search(?string $search): self
    {
        return new self(
            page: $this->page,
            perPage: $this->perPage,
            search: $search,
            sortBy: $this->sortBy,
            sortDirection: $this->sortDirection,
            filters: $this->filters,
            hiddenColumns: $this->hiddenColumns,
            density: $this->density,
        );
    }

    public function sort(string $column, string $direction = 'asc'): self
    {
        return new self(
            page: $this->page,
            perPage: $this->perPage,
            search: $this->search,
            sortBy: $column,
            sortDirection: strtolower($direction) === 'desc' ? 'desc' : 'asc',
            filters: $this->filters,
            hiddenColumns: $this->hiddenColumns,
            density: $this->density,
        );
    }

    public function filters(array $filters): self
    {
        return new self(
            page: $this->page,
            perPage: $this->perPage,
            search: $this->search,
            sortBy: $this->sortBy,
            sortDirection: $this->sortDirection,
            filters: $filters,
            hiddenColumns: $this->hiddenColumns,
            density: $this->density,
        );
    }

    public function hideColumns(array $columns): self
    {
        return new self(
            page: $this->page,
            perPage: $this->perPage,
            search: $this->search,
            sortBy: $this->sortBy,
            sortDirection: $this->sortDirection,
            filters: $this->filters,
            hiddenColumns: $columns,
            density: $this->density,
        );
    }

    public function density(string $density): self
    {
        return new self(
            page: $this->page,
            perPage: $this->perPage,
            search: $this->search,
            sortBy: $this->sortBy,
            sortDirection: $this->sortDirection,
            filters: $this->filters,
            hiddenColumns: $this->hiddenColumns,
            density: $density,
        );
    }
}