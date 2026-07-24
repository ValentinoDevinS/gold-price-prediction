<?php

namespace App\View\Components\Ui;

use App\Support\Ui\Styles\BreadcrumbStyle;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    /**
     * @param BreadcrumbItem[] $items
     */
    public function __construct(
        public array $items = [],
    ) {}

    public function style(): BreadcrumbStyle
    {
        return new BreadcrumbStyle();
    }

    public function render(): View
    {
        return view('components.ui.breadcrumb');
    }
}