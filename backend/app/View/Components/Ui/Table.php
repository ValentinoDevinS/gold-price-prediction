<?php

declare(strict_types=1);

namespace App\View\Components\Ui;

use App\Data\Ui\TableData;
use App\Support\Ui\Styles\TableStyle;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public LengthAwarePaginator $rows;

    public array $columns;

    public array $filters;

    public array $actions;

    public array $bulkActions;

    public array $exportFormats;

    public bool $showSearch;

    public bool $showExport;

    public bool $showBulkActions;

    public bool $showDensity;

    public bool $showColumnVisibility;

    public function __construct(
        public TableData $table,
    ) {
        $this->rows = $table->rows;

        $this->columns = $table->columns;

        $this->filters = $table->filters;

        $this->actions = $table->actions;

        $this->bulkActions = $table->bulkActions;

        $this->exportFormats = $table->exportFormats;

        $this->showSearch = $table->showSearch;

        $this->showExport = $table->showExport;

        $this->showBulkActions = $table->showBulkActions;

        $this->showDensity = $table->showDensity;

        $this->showColumnVisibility = $table->showColumnVisibility;
    }

    public function state()
    {
        return $this->table->state;
    }

    public function style(): TableStyle
    {
        return new TableStyle();
    }

    public function render(): View
    {
        return view('components.ui.table.index');
    }
}