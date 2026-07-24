<?php

namespace App\View\Components\Ui\Table;

use App\Support\Ui\Styles\TableSearchStyle;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Search extends Component
{
    public function __construct(
        public string $name = 'search',
        public ?string $value = null,
        public string $placeholder = 'Search...',
    ) {}

    public function style(): TableSearchStyle
    {
        return new TableSearchStyle();
    }

    public function render(): View
    {
        return view('components.ui.table.search');
    }
}