<?php

namespace App\Enums;

enum ArticleStatus: string
{
    case NEW = 'NEW';

    case DOWNLOADED = 'DOWNLOADED';

    case FAILED = 'FAILED';

    case SKIPPED = 'SKIPPED';
}