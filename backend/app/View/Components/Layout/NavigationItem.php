<?php

declare(strict_types=1);

namespace App\Support\Navigation;

use App\Data\Layout\NavigationGroup;
use App\Data\Layout\NavigationItem;

final class NavigationBuilder
{
    /**
     * @return NavigationGroup[]
     */
    public function build(): array
    {
        return [

            NavigationGroup::make(
                'General',
                [
                    NavigationItem::make('Dashboard', 'dashboard')
                        ->icon('heroicon-o-home'),
                ],
            ),

            NavigationGroup::make(
                'Data',
                [
                    NavigationItem::make('News', 'news.index')
                        ->icon('heroicon-o-newspaper'),

                    NavigationItem::make('Gold Prices', 'gold-prices.index')
                        ->icon('heroicon-o-currency-dollar'),
                ],
            ),

            NavigationGroup::make(
                'Prediction',
                [
                    NavigationItem::make('Sentiment Analysis', 'sentiment.index')
                        ->icon('heroicon-o-face-smile'),

                    NavigationItem::make('Predictions', 'predictions.index')
                        ->icon('heroicon-o-chart-bar'),

                    NavigationItem::make('Model Performance', 'performance.index')
                        ->icon('heroicon-o-chart-pie'),
                ],
            ),

            NavigationGroup::make(
                'System',
                [
                    NavigationItem::make('Settings', 'settings.index')
                        ->icon('heroicon-o-cog-6-tooth'),
                ],
            ),

        ];
    }
}