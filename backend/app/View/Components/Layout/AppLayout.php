<?php

namespace App\View\Components\Layout;

use App\View\Components\BaseComponent;
use Closure;
use Illuminate\Contracts\View\View;

class AppLayout extends BaseComponent
{
    public function render(): View|Closure|string
    {
        return view('components.layout.app-layout');
    }
}