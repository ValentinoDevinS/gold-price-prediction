<?php

declare(strict_types=1);

namespace App\Enums;

enum PipelineStage: string
{
    case SCRAPER = 'scraper';

    case DOWNLOADER = 'downloader';

    case CLEANER = 'cleaner';

    case SENTIMENT = 'sentiment';

    case FEATURE = 'feature';

    case TRAINING = 'training';

    case PREDICTION = 'prediction';

    case EVALUATION = 'evaluation';
}