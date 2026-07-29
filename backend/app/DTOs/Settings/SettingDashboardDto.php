<?php

declare(strict_types=1);

namespace App\DTOs\Settings;

use App\Support\Table\TableData;

/**
 * Dashboard Data Transfer Object for System Settings.
 *
 * Combines all data required by the Settings dashboard.
 */
final readonly class SettingDashboardDto
{
    /**
     * @param array<string, mixed> $statistics
     */
    public function __construct(
        public array $statistics,
        public TableData $table,
    ) {
    }

    /**
     * Create a new dashboard DTO.
     *
     * @param array<string, mixed> $statistics
     */
    public static function make(
        array $statistics,
        TableData $table,
    ): self {
        return new self(
            statistics: $statistics,
            table: $table,
        );
    }
}