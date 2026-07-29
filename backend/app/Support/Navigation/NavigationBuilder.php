<?php

declare(strict_types=1);

namespace App\Support\Navigation;

use App\Data\Layout\NavigationGroup;
use App\Data\Layout\NavigationItem;
use Illuminate\Support\Facades\Route;

final class NavigationBuilder
{
    /**
     * @return NavigationGroup[]
     */
    public function build(): array
    {
        return array_values(array_filter([

            NavigationGroup::make(
                'General',
                $this->filter([
                    NavigationItem::make(
                        label: 'Dashboard',
                        route: 'dashboard',
                    )->icon('home'),
                ])
            ),

            NavigationGroup::make(
                'Data Collection',
                $this->filter([
                    NavigationItem::make(
                        label: 'Articles',
                        route: 'articles.index',
                    )->icon('newspaper'),

                    NavigationItem::make(
                        label: 'Full Articles',
                        route: 'full-articles.index',
                    )->icon('file-text'),

                    NavigationItem::make(
                        label: 'Clean Articles',
                        route: 'clean-articles.index',
                    )->icon('file-search'),

                    NavigationItem::make(
                        label: 'Gold Prices',
                        route: 'gold-prices.index',
                    )->icon('coins'),
                ])
            ),

            NavigationGroup::make(
                'AI Pipeline',
                $this->filter([

                    NavigationItem::make(
                        label: 'Sentiment Analysis',
                        route: 'sentiment.index',
                    )->icon('message-circle'),

                    NavigationItem::make(
                        label: 'Feature Engineering',
                        route: 'feature-engineering.index',
                    )->icon('database'),

                    NavigationItem::make(
                        label: 'Training',
                        route: 'training.index',
                    )->icon('cpu'),

                    NavigationItem::make(
                        label: 'Prediction',
                        route: 'prediction.index',
                    )->icon('brain'),

                    NavigationItem::make(
                        label: 'Performance',
                        route: 'performance.index',
                    )->icon('bar-chart-3'),

                ])
            ),

            NavigationGroup::make(
                'System',
                $this->filter([
                    NavigationItem::make(
                        label: 'Pipeline Monitor',
                        route: 'pipeline.index',
                    )->icon('activity'),

                    NavigationItem::make(
                        label: 'Logs',
                        route: 'logs.index',
                    )->icon('file-text'),

                    NavigationItem::make(
                        label: 'Settings',
                        route: 'settings.index',
                    )->icon('settings'),
                ])
            ),

        ], fn (NavigationGroup $group) => ! empty($group->items)));
    }

    /**
     * @param NavigationItem[] $items
     * @return NavigationItem[]
     */
    private function filter(array $items): array
    {
        return array_values(array_filter(
            $items,
            fn (NavigationItem $item) => Route::has($item->route)
        ));
    }
}