<?php

declare(strict_types=1);

namespace App\Services\Table;

use App\DTOs\Table\TableAction;
use App\DTOs\Table\TableColumn;
use App\DTOs\Table\TableData;
use App\DTOs\Table\TableFilter;
use App\DTOs\Table\TableState;
use Illuminate\Support\Collection;

class TableBuilder
{
    protected Collection $rows;

    /**
     * @var TableColumn[]
     */
    protected array $columns = [];

    /**
     * @var TableAction[]
     */
    protected array $actions = [];

    /**
     * @var TableFilter[]
     */
    protected array $filters = [];

    protected TableState $state;

    public function __construct()
    {
        $this->rows = collect();
        $this->state = TableState::make();
    }

    public static function make(): static
    {
        return new static();
    }

    public function rows(Collection $rows): static
    {
        $this->rows = $rows;

        return $this;
    }

    /**
     * @param TableColumn[] $columns
     */
    public function columns(array $columns): static
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * @param TableAction[] $actions
     */
    public function actions(array $actions): static
    {
        $this->actions = $actions;

        return $this;
    }

    /**
     * @param TableFilter[] $filters
     */
    public function filters(array $filters): static
    {
        $this->filters = $filters;

        return $this;
    }

    public function state(TableState $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function build(): TableData
    {
        return TableData::make()
            ->rows($this->rows)
            ->columns($this->columns)
            ->actions($this->actions)
            ->filters($this->filters)
            ->state($this->state);
    }
}