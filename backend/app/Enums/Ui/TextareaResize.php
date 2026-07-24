<?php

namespace App\Enums\Ui;

enum TextareaResize: string
{
    case None = 'none';
    case Vertical = 'vertical';
    case Horizontal = 'horizontal';
    case Both = 'both';
}