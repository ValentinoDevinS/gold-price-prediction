<?php

namespace App\View\Components\Ui\Table;

use App\Data\Ui\BulkAction;
use App\Data\Ui\DropdownItem;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BulkActions extends Component
{
    /**
     * @param BulkAction[] $actions
     */
    public function __construct(
        public array $actions = [],
    ) {}

    /**
     * @return DropdownItem[]
     */
    public function items(): array
    {
        return array_map(
            fn (BulkAction $action) => DropdownItem::make(
                label: $action->label,
                value: $action->value,
            )
                ->icon($action->icon ?? ''),
            $this->actions,
        );
    }

    public function render(): View
    {
        return view('components.ui.table.bulk-actions');
    }
}