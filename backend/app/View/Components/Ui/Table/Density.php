<?php

namespace App\View\Components\Ui\Table;

use App\Data\Ui\DropdownItem;
use App\Enums\Ui\TableDensity;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Density extends Component
{
    public function __construct(
        public TableDensity $current = TableDensity::Comfortable,
    ) {}

    /**
     * @return DropdownItem[]
     */
    public function items(): array
    {
        return array_map(
            fn (TableDensity $density) => DropdownItem::make(
                label: ucfirst($density->value),
                value: $density->value,
            ),
            TableDensity::cases(),
        );
    }

    public function render(): View
    {
        return view('components.ui.table.density');
    }
}