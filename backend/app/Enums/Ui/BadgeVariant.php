<?php

namespace App\Enums\Ui;

enum BadgeVariant: string
{
    case Primary = 'primary';
    case Success = 'success';
    case Warning = 'warning';
    case Danger = 'danger';
    case Info = 'info';
    case Secondary = 'secondary';
}