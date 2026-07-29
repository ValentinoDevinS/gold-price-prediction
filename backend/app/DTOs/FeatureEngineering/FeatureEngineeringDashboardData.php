<?php

declare(strict_types=1);

namespace App\DTOs\FeatureEngineering;

use App\Support\Table\Table;

final readonly class FeatureEngineeringDashboardData
{
    public function __construct(

        public array $statistics,

        public ?FeatureEngineeringData $latestFeature,

        public Table $table,

    ) {
    }
}