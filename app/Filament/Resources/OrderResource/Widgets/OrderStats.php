<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStats extends BaseWidget
{
    // Defines the statistics to be displayed in the widget
    protected function getStats(): array
    {
        // Calculate the average order price in cents
        $averagePriceInCents = Order::query()->avg('grand_total');

        // Convert the average price from cents to euros
        $averagePriceInEuros = $averagePriceInCents / 100;

        // Return an array of Stat objects, each representing a different statistic
        return [
            // Stat for the count of new orders
            Stat::make('New Orders', Order::query()->where('status', 'new')->count()),

            // Stat for the count of orders that are being processed
            Stat::make('Order Processing', Order::query()->where('status', 'processing')->count()),

            // Stat for the count of orders that have been shipped
            Stat::make('Order Shipped', Order::query()->where('status', 'shipped')->count()),

            // Stat for the average price of orders, formatted as a euro amount
            Stat::make('Average Price', sprintf('€%.2f', $averagePriceInEuros)),
        ];
    }
}
