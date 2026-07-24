<?php

namespace App\View\Components\Layout;

use App\Support\Layout\Styles\TopbarStyle;
use Illuminate\Contracts\View\View;
use App\View\Components\BaseComponent;

class Topbar extends BaseComponent
{
    public function style(): TopbarStyle
    {
        return new TopbarStyle();
    }

    public function render(): View
    {
        return view('components.layout.topbar');
    }
}