<?php

declare(strict_types=1);

namespace App\Data\Ui;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class TableData
{
    /**
     * @param TableColumn[] $columns
     * @param TableFilter[] $filters
     * @param TableAction[] $actions
     * @param TableAction[] $bulkActions
     * @param string[] $exportFormats
     */
    public function __construct(
        public LengthAwarePaginator $rows,

        public array $columns = [],

        public array $filters = [],

        public array $actions = [],

        public array $bulkActions = [],

        public array $exportFormats = [],

        public ?TableState $state = null,

        public bool $showSearch = true,

        public bool $showExport = true,

        public bool $showBulkActions = true,

        public bool $showDensity = true,

        public bool $showColumnVisibility = true,
    ) {
        $this->state ??= TableState::make();
    }

    public static function make(
        LengthAwarePaginator $rows,
    ): self {
        return new self($rows);
    }

    /**
     * @param TableColumn[] $columns
     */
    public function columns(array $columns): self
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * @param TableFilter[] $filters
     */
    public function filters(array $filters): self
    {
        $this->filters = $filters;

        return $this;
    }

    /**
     * @param TableAction[] $actions
     */
    public function actions(array $actions): self
    {
        $this->actions = $actions;

        return $this;
    }

    /**
     * @param TableAction[] $actions
     */
    public function bulkActions(array $actions): self
    {
        $this->bulkActions = $actions;

        return $this;
    }

    /**
     * @param string[] $formats
     */
    public function exportFormats(array $formats): self
    {
        $this->exportFormats = $formats;

        return $this;
    }

    public function state(TableState $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function search(bool $enabled = true): self
    {
        $this->showSearch = $enabled;

        return $this;
    }

    public function export(bool $enabled = true): self
    {
        $this->showExport = $enabled;

        return $this;
    }

    public function density(bool $enabled = true): self
    {
        $this->showDensity = $enabled;

        return $this;
    }

    public function columnVisibility(bool $enabled = true): self
    {
        $this->showColumnVisibility = $enabled;

        return $this;
    }

    public function bulk(bool $enabled = true): self
    {
        $this->showBulkActions = $enabled;

        return $this;
    }
}