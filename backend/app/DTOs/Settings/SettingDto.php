<?php

declare(strict_types=1);

namespace App\DTOs\Settings;

use App\Enums\SettingCategory;
use App\Enums\SettingType;
use App\Models\SystemSetting;
use Illuminate\Database\Eloquent\Collection;

/**
 * Data Transfer Object for System Settings.
 */
final readonly class SettingDto
{
    public function __construct(
        public int $id,
        public string $uuid,
        public SettingCategory $category,
        public string $key,
        public string $label,
        public ?string $description,
        public mixed $value,
        public SettingType $type,
        public ?array $options,
        public bool $isEditable,
    ) {
    }

    /**
     * Create DTO from model.
     */
    public static function fromModel(SystemSetting $setting): self
    {
        return new self(
            id: $setting->id,
            uuid: $setting->uuid,
            category: $setting->category,
            key: $setting->key,
            label: $setting->label,
            description: $setting->description,
            value: $setting->value,
            type: $setting->type,
            options: $setting->options,
            isEditable: $setting->is_editable,
        );
    }

    /**
     * Convert a collection of models into DTOs.
     *
     * @param Collection<int, SystemSetting>|array<SystemSetting> $settings
     * @return array<int, self>
     */
    public static function collection(Collection|array $settings): array
    {
        if ($settings instanceof Collection) {
            $settings = $settings->all();
        }

        return array_map(
            static fn (SystemSetting $setting): self => self::fromModel($setting),
            $settings,
        );
    }
}