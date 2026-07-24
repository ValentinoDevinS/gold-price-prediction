<?php

declare(strict_types=1);

namespace App\Support\Ui;

abstract class BaseStyle
{
    protected function builder(): ClassBuilder
    {
        return new ClassBuilder();
    }
}