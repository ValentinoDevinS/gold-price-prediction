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
                $this->items([
                    ['Dashboard', 'dashboard'],
                ]),
            ),

            NavigationGroup::make(
                'Data',
                $this->items([
                    ['News', 'news.index'],
                    ['Gold Prices', 'gold-prices.index'],
                ]),
            ),

            NavigationGroup::make(
                'Prediction',
                $this->items([
                    ['Sentiment', 'sentiment.index'],
                    ['Prediction', 'prediction.index'],
                    ['Performance', 'performance.index'],
                ]),
            ),
        ], fn (NavigationGroup $group) => ! empty($group->items)));
    }

    /**
     * Build navigation items from route definitions.
     *
     * @param array<int, array{0:string,1:string}> $definitions
     * @return NavigationItem[]
     */
    private function items(array $definitions): array
    {
        $items = [];

        foreach ($definitions as [$label, $route]) {
            if (! Route::has($route)) {
                continue;
            }

            $items[] = NavigationItem::make(
                label: $label,
                route: $route,
            );
        }

        return $items;
    }
}