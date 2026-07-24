<?php

namespace App\View\Components\Ui\Table;

use App\Data\Ui\DropdownItem;
use App\Data\Ui\TableColumn;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ColumnVisibility extends Component
{
    /**
     * @param TableColumn[] $columns
     */
    public function __construct(
        public array $columns = [],
    ) {}

    /**
     * @return DropdownItem[]
     */
    public function items(): array
    {
        $items = [];

        foreach ($this->columns as $column) {

            if (! $column->toggleable) {
                continue;
            }

            $items[] = DropdownItem::make(
                label: $column->label,
                value: $column->key,
            )->checked(! $column->hidden);
        }

        return $items;
    }

    public function render(): View
    {
        return view('components.ui.table.column-visibility');
    }
}