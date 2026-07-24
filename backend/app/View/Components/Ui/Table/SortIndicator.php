<?php

namespace App\View\Components\Ui\Table;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SortIndicator extends Component
{
    public function __construct(
        public bool $active = false,
        public string $direction = 'asc',
    ) {}

    public function render(): View
    {
        return view('components.ui.table.sort-indicator');
    }
}