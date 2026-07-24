<?php

namespace App\View\Components\Ui;

use App\Support\Ui\Styles\SkeletonStyle;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Skeleton extends Component
{
    public function __construct(
        public ?string $class = null,
    ) {}

    public function style(): SkeletonStyle
    {
        return new SkeletonStyle();
    }

    public function render(): View
    {
        return view('components.ui.skeleton');
    }
}