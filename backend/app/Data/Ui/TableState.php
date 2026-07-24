<?php

namespace App\Data\Ui;

class TableState
{
    public function __construct(
        public string $search = '',

        public ?string $sortColumn = null,

        public string $sortDirection = 'asc',

        public int $page = 1,

        public int $perPage = 10,

        public array $filters = [],

        public array $selectedRows = [],

    ) {
    }

    /**
     * Create default state.
     */
    public static function make(): self
    {
        return new self();
    }

    /**
     * Check whether searching is active.
     */
    public function hasSearch(): bool
    {
        return $this->search !== '';
    }

    /**
     * Check whether filters are active.
     */
    public function hasFilters(): bool
    {
        return ! empty($this->filters);
    }

    /**
     * Check whether rows are selected.
     */
    public function hasSelection(): bool
    {
        return ! empty($this->selectedRows);
    }

    /**
     * Check whether sorting is active.
     */
    public function hasSorting(): bool
    {
        return $this->sortColumn !== null;
    }
}