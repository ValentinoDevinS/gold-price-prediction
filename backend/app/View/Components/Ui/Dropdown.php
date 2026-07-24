<?php

namespace App\View\Components\Ui;

use App\Data\Ui\DropdownItem;
use App\Support\Ui\Styles\DropdownStyle;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dropdown extends Component
{
    /**
     * @param DropdownItem[] $items
     */
    public function __construct(
        public string $label,
        public array $items = [],
    ) {}

    public function style(): DropdownStyle
    {
        return new DropdownStyle();
    }

    public function render(): View
    {
        return view('components.ui.dropdown');
    }
}