<?php

namespace App\View\Components\Layout;

use App\Data\Layout\NavigationGroup as NavigationGroupData;
use App\Support\Layout\Styles\NavigationGroupStyle;
use Illuminate\Contracts\View\View;
use App\View\Components\BaseComponent;

class NavigationGroup extends BaseComponent
{
    public function __construct(
        public NavigationGroupData $group,
    ) {}

    public function style(): NavigationGroupStyle
    {
        return new NavigationGroupStyle();
    }

    public function render(): View
    {
        return view('components.layout.navigation-group');
    }
}