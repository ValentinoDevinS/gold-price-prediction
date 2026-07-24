<?php

declare(strict_types=1);

namespace App\View\Components\Layout;

use App\Data\Layout\NavigationItem as NavigationItemData;
use App\Support\Layout\Styles\NavigationItemStyle;
use App\View\Components\BaseComponent;
use Illuminate\Contracts\View\View;

final class NavigationItem extends BaseComponent
{
    public function __construct(
        public NavigationItemData $item,
    ) {
    }

    public function style(): NavigationItemStyle
    {
        return new NavigationItemStyle();
    }

    public function active(): bool
    {
        return request()->routeIs($this->item->route);
    }

    public function render(): View
    {
        return view('components.layout.navigation-item');
    }
}