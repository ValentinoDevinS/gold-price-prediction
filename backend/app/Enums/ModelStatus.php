<?php

namespace App\Enums;

enum ModelStatus: string
{
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
    case ARCHIVED = 'ARCHIVED';
}