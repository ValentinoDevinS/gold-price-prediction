<?php

declare(strict_types=1);

namespace App\DTOs\Table;

use Illuminate\Support\Collection;

final class TableData
{
    /**
     * @param Collection<int, mixed> $rows
     * @param array<TableColumn> $columns
     * @param array<TableAction> $actions
     * @param array<TableFilter> $filters
     */
    private function __construct(
        public readonly Collection $rows,
        public readonly array $columns,
        public readonly array $actions,
        public readonly array $filters,
        public readonly TableState $state,
        public readonly bool $striped = true,
        public readonly bool $hover = true,
        public readonly bool $bordered = false,
        public readonly bool $paginated = true,
        public readonly bool $searchable = true,
        public readonly bool $exportable = true,
    ) {
    }

    public static function make(): self
    {
        return new self(
            rows: collect(),
            columns: [],
            actions: [],
            filters: [],
            state: TableState::make(),
        );
    }

    public function rows(Collection $rows): self
    {
        return new self(
            rows: $rows,
            columns: $this->columns,
            actions: $this->actions,
            filters: $this->filters,
            state: $this->state,
            striped: $this->striped,
            hover: $this->hover,
            bordered: $this->bordered,
            paginated: $this->paginated,
            searchable: $this->searchable,
            exportable: $this->exportable,
        );
    }

    /**
     * @param array<TableColumn> $columns
     */
    public function columns(array $columns): self
    {
        return new self(
            rows: $this->rows,
            columns: $columns,
            actions: $this->actions,
            filters: $this->filters,
            state: $this->state,
            striped: $this->striped,
            hover: $this->hover,
            bordered: $this->bordered,
            paginated: $this->paginated,
            searchable: $this->searchable,
            exportable: $this->exportable,
        );
    }

    /**
     * @param array<TableAction> $actions
     */
    public function actions(array $actions): self
    {
        return new self(
            rows: $this->rows,
            columns: $this->columns,
            actions: $actions,
            filters: $this->filters,
            state: $this->state,
            striped: $this->striped,
            hover: $this->hover,
            bordered: $this->bordered,
            paginated: $this->paginated,
            searchable: $this->searchable,
            exportable: $this->exportable,
        );
    }

    /**
     * @param array<TableFilter> $filters
     */
    public function filters(array $filters): self
    {
        return new self(
            rows: $this->rows,
            columns: $this->columns,
            actions: $this->actions,
            filters: $filters,
            state: $this->state,
            striped: $this->striped,
            hover: $this->hover,
            bordered: $this->bordered,
            paginated: $this->paginated,
            searchable: $this->searchable,
            exportable: $this->exportable,
        );
    }

    public function state(TableState $state): self
    {
        return new self(
            rows: $this->rows,
            columns: $this->columns,
            actions: $this->actions,
            filters: $this->filters,
            state: $state,
            striped: $this->striped,
            hover: $this->hover,
            bordered: $this->bordered,
            paginated: $this->paginated,
            searchable: $this->searchable,
            exportable: $this->exportable,
        );
    }

    public function striped(bool $value = true): self
    {
        return $this->copy(striped: $value);
    }

    public function hover(bool $value = true): self
    {
        return $this->copy(hover: $value);
    }

    public function bordered(bool $value = true): self
    {
        return $this->copy(bordered: $value);
    }

    public function paginated(bool $value = true): self
    {
        return $this->copy(paginated: $value);
    }

    public function searchable(bool $value = true): self
    {
        return $this->copy(searchable: $value);
    }

    public function exportable(bool $value = true): self
    {
        return $this->copy(exportable: $value);
    }

    private function copy(
        ?Collection $rows = null,
        ?array $columns = null,
        ?array $actions = null,
        ?array $filters = null,
        ?TableState $state = null,
        ?bool $striped = null,
        ?bool $hover = null,
        ?bool $bordered = null,
        ?bool $paginated = null,
        ?bool $searchable = null,
        ?bool $exportable = null,
    ): self {
        return new self(
            rows: $rows ?? $this->rows,
            columns: $columns ?? $this->columns,
            actions: $actions ?? $this->actions,
            filters: $filters ?? $this->filters,
            state: $state ?? $this->state,
            striped: $striped ?? $this->striped,
            hover: $hover ?? $this->hover,
            bordered: $bordered ?? $this->bordered,
            paginated: $paginated ?? $this->paginated,
            searchable: $searchable ?? $this->searchable,
            exportable: $exportable ?? $this->exportable,
        );
    }
}