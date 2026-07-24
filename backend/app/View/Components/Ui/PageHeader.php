<?php

namespace App\View\Components\Ui;

use App\Support\Ui\Styles\PageHeaderStyle;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageHeader extends Component
{
    public function __construct(
        public string $title,
        public ?string $description = null,
    ) {}

    public function style(): PageHeaderStyle
    {
        return new PageHeaderStyle();
    }

    public function render(): View
    {
        return view('components.ui.page-header');
    }
}