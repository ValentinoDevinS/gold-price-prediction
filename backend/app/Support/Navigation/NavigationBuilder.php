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
                    NavigationItem::make('Dashboard', 'dashboard'),
                ],
            ),

            NavigationGroup::make(
                'Data',
                [
                    NavigationItem::make('News', 'news.index'),
                    NavigationItem::make('Gold Prices', 'gold-prices.index'),
                ],
            ),

            NavigationGroup::make(
                'Prediction',
                [
                    NavigationItem::make('Sentiment', 'sentiment.index'),
                    NavigationItem::make('Prediction', 'prediction.index'),
                    NavigationItem::make('Performance', 'performance.index'),
                ],
            ),

        ];
    }
}