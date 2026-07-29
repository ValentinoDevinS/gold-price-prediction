<?php

declare(strict_types=1);

namespace App\Services\Settings;

use App\Repositories\Settings\SettingRepository;

final readonly class SettingStatisticService
{
    public function __construct(
        private SettingRepository $repository,
    ) {
    }

    /**
     * Get dashboard statistics.
     *
     * @return array<string, int>
     */
    public function getStatistics(): array
    {
        return [
            'total_settings' => $this->repository->count(),
            'editable' => $this->repository->editableCount(),
            'readonly' => $this->repository->readonlyCount(),
            'categories' => $this->repository->categoryCount(),
        ];
    }
}