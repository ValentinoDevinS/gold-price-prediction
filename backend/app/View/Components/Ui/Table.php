<?php

namespace App\View\Components\Ui;

use App\Data\Ui\TableAction;
use App\Data\Ui\TableColumn;
use App\Data\Ui\TableFilter;
use App\Data\Ui\TableState;
use App\Enums\Ui\TableDensity;
use App\Support\Ui\Styles\TableStyle;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    /**
     * @param TableColumn[] $columns
     * @param TableFilter[] $filters
     * @param TableAction[] $actions
     * @param DropdownItem[] $bulkActions
     * @param ExportFormat[] $exportFormats
     */
    public function __construct(
        public LengthAwarePaginator $rows,

        public array $columns = [],

        public array $filters = [],

        public array $actions = [],

        public array $bulkActions = [],

        public array $exportFormats = [],

        public ?TableState $state = null,

        public TableDensity $density = TableDensity::Comfortable,

        public bool $showSearch = true,

        public bool $showExport = true,

        public bool $showBulkActions = true,

        public bool $showDensity = true,

        public bool $showColumnVisibility = true,
    ) {
        $this->state ??= TableState::make();
    }

    public function style(): TableStyle
    {
        return new TableStyle(
            density: $this->density,
        );
    }

    public function render(): View
    {
        return view('components.ui.table.index');
    }
}