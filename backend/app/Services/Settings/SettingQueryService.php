<?php

declare(strict_types=1);

namespace App\Services\Settings;

use App\DTOs\Settings\SettingDto;
use App\Enums\SettingCategory;
use App\Repositories\Settings\SettingRepository;

final readonly class SettingQueryService
{
    public function __construct(
        private SettingRepository $repository,
    ) {
    }

    /**
     * Get all settings.
     *
     * @return array<int, SettingDto>
     */
    public function all(): array
    {
        return SettingDto::collection(
            $this->repository->all()
        );
    }

    /**
     * Get settings by category.
     *
     * @return array<int, SettingDto>
     */
    public function byCategory(
        SettingCategory $category,
    ): array {
        return SettingDto::collection(
            $this->repository->byCategory($category)
        );
    }

    /**
     * Find setting by UUID.
     */
    public function findByUuid(
        string $uuid,
    ): ?SettingDto {
        $setting = $this->repository->findByUuid($uuid);

        if ($setting === null) {
            return null;
        }

        return SettingDto::fromModel($setting);
    }

    /**
     * Find setting by key.
     */
    public function findByKey(
        string $key,
    ): ?SettingDto {
        $setting = $this->repository->findByKey($key);

        if ($setting === null) {
            return null;
        }

        return SettingDto::fromModel($setting);
    }

    /**
     * Group settings by category.
     *
     * @return array<string, array<int, SettingDto>>
     */
    public function grouped(): array
    {
        $settings = $this->all();

        $grouped = [];

        foreach ($settings as $setting) {
            $grouped[$setting->category->value][] = $setting;
        }

        return $grouped;
    }
}