<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Support\Ui\ClassBuilder;
use Illuminate\View\Component;

abstract class BaseComponent extends Component
{
    /**
     * Create a new CSS class builder.
     */
    protected function classBuilder(): ClassBuilder
    {
        return new ClassBuilder();
    }
}