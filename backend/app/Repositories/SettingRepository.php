<?php

declare(strict_types=1);

namespace App\Repositories\Settings;

use App\Enums\SettingCategory;
use App\Models\SystemSetting;
use Illuminate\Database\Eloquent\Collection;

final readonly class SettingRepository
{
    /**
     * Retrieve all settings ordered by category and label.
     *
     * @return Collection<int, SystemSetting>
     */
    public function all(): Collection
    {
        return SystemSetting::query()
            ->orderBy('category')
            ->orderBy('label')
            ->get();
    }

    /**
     * Retrieve settings by category.
     *
     * @return Collection<int, SystemSetting>
     */
    public function byCategory(
        SettingCategory $category,
    ): Collection {
        return SystemSetting::query()
            ->where('category', $category)
            ->orderBy('label')
            ->get();
    }

    /**
     * Find a setting by UUID.
     */
    public function findByUuid(
        string $uuid,
    ): ?SystemSetting {
        return SystemSetting::query()
            ->where('uuid', $uuid)
            ->first();
    }

    /**
     * Find a setting by key.
     */
    public function findByKey(
        string $key,
    ): ?SystemSetting {
        return SystemSetting::query()
            ->where('key', $key)
            ->first();
    }

    /**
     * Update a setting.
     */
    public function update(
        SystemSetting $setting,
        array $attributes,
    ): bool {
        return $setting->update($attributes);
    }

    /**
     * Count all settings.
     */
    public function count(): int
    {
        return SystemSetting::query()->count();
    }

    /**
     * Count editable settings.
     */
    public function editableCount(): int
    {
        return SystemSetting::query()
            ->where('is_editable', true)
            ->count();
    }

    /**
     * Count readonly settings.
     */
    public function readonlyCount(): int
    {
        return SystemSetting::query()
            ->where('is_editable', false)
            ->count();
    }

    /**
     * Count categories.
     */
    public function categoryCount(): int
    {
        return SystemSetting::query()
            ->distinct('category')
            ->count('category');
    }
}