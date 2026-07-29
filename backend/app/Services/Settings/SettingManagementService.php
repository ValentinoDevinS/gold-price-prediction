<?php

declare(strict_types=1);

namespace App\Services\Settings;

use App\Models\SystemSetting;
use App\Repositories\Settings\SettingRepository;
use Illuminate\Database\DatabaseManager;
use RuntimeException;

final readonly class SettingManagementService
{
    public function __construct(
        private SettingRepository $repository,
        private DatabaseManager $database,
    ) {
    }

    /**
     * Update a setting.
     *
     * @param array<string, mixed> $attributes
     */
    public function update(
        string $uuid,
        array $attributes,
    ): SystemSetting {

        return $this->database->transaction(

            function () use ($uuid, $attributes): SystemSetting {

                $setting = $this->repository->findByUuid($uuid);

                if ($setting === null) {
                    throw new RuntimeException('Setting not found.');
                }

                if (! $setting->is_editable) {
                    throw new RuntimeException('This setting is read only.');
                }

                $this->repository->update(
                    $setting,
                    [
                        'value' => $attributes['value'],
                        'description' => $attributes['description'] ?? $setting->description,
                    ],
                );

                return $setting->refresh();
            },

        );
    }

    /**
     * Bulk update settings.
     *
     * @param array<int, array<string, mixed>> $settings
     */
    public function bulkUpdate(
        array $settings,
    ): void {

        $this->database->transaction(

            function () use ($settings): void {

                foreach ($settings as $item) {

                    $this->update(
                        $item['uuid'],
                        $item,
                    );

                }

            },

        );
    }
}