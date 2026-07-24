<?php

namespace App\View\Components\Layout;

use App\Support\Layout\Styles\PageContentStyle;
use Illuminate\Contracts\View\View;
use App\View\Components\BaseComponent;

class PageContent extends BaseComponent
{
    public function style(): PageContentStyle
    {
        return new PageContentStyle();
    }

    public function render(): View
    {
        return view('components.layout.page-content');
    }
}