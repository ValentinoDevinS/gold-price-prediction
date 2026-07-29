<?php

declare(strict_types=1);

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\BulkUpdateSettingRequest;
use App\Http\Requests\Settings\UpdateSettingRequest;
use App\Services\Settings\SettingDashboardService;
use App\Services\Settings\SettingManagementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class SettingController extends Controller
{
    public function __construct(
        private readonly SettingDashboardService $dashboardService,
        private readonly SettingManagementService $managementService,
    ) {
    }

    /**
     * Display the settings page.
     */
    public function index(): View
    {
        return view(
            'settings.index',
            [
                'dashboard' => $this->dashboardService->build(),
            ],
        );
    }

    /**
     * Update a single setting.
     */
    public function update(
        UpdateSettingRequest $request,
        string $uuid,
    ): RedirectResponse {

        $this->managementService->update(
            uuid: $uuid,
            attributes: $request->validated(),
        );

        return redirect()
            ->route('settings.index')
            ->with(
                'success',
                'Setting updated successfully.',
            );
    }

    /**
     * Update multiple settings.
     */
    public function bulkUpdate(
        BulkUpdateSettingRequest $request,
    ): RedirectResponse {

        $this->managementService->bulkUpdate(
            $request->validated()['settings'],
        );

        return redirect()
            ->route('settings.index')
            ->with(
                'success',
                'Settings updated successfully.',
            );
    }
}