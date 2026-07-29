<?php

declare(strict_types=1);

namespace App\Enums;

enum SettingCategory: string
{
    case DATA_COLLECTION = 'data_collection';

    case TRAINING = 'training';

    case PREDICTION = 'prediction';

    case SCHEDULER = 'scheduler';
}