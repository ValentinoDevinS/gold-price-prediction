<?php

declare(strict_types=1);

namespace App\Enums;

enum SettingType: string
{
    case STRING = 'string';

    case INTEGER = 'integer';

    case BOOLEAN = 'boolean';

    case FLOAT = 'float';

    case JSON = 'json';

    case TIME = 'time';
}