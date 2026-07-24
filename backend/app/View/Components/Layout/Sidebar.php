<?php

namespace App\View\Components\Layout;

use App\Data\Layout\NavigationGroup;
use App\Support\Layout\Styles\SidebarStyle;
use App\Support\Navigation\Navigation;
use App\View\Components\BaseComponent;
use Illuminate\Contracts\View\View;

class Sidebar extends BaseComponent
{
    /**
     * @param NavigationGroup[] $groups
     */
    public function groups(): array
    {
        return Navigation::groups();
    }

    public function style(): SidebarStyle
    {
        return new SidebarStyle();
    }

    public function render(): View
    {
        return view('components.layout.sidebar');
    }
}