<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListOrders extends ListRecords
{
    // Specifies the resource class that this page is for
    protected static string $resource = OrderResource::class;

    // Defines the actions that appear in the header of the list page
    protected function getHeaderActions(): array
    {
        return [
            // Adds a Create action button to the header
            Actions\CreateAction::make(),
        ];
    }

    // Defines the widgets that appear in the header of the list page
    protected function getHeaderWidgets(): array
    {
        return [
            // Adds the OrderStats widget to the header
            OrderStats::class,
        ];
    }

    // Defines the tabs for filtering the orders based on their status
    public function getTabs(): array
    {
        return [
            // Default tab that shows all orders
            null => Tab::make('All Orders'),

            // Tab that shows only new orders
            'new' => Tab::make('New Orders')
                ->query(fn (Builder $query) => $query->where('status', 'new')),

            // Tab that shows only processing orders
            'processing' => Tab::make('Processing Orders')
                ->query(fn (Builder $query) => $query->where('status', 'processing')),

            // Tab that shows only shipped orders
            'shipped' => Tab::make('Shipped Orders')
                ->query(fn (Builder $query) => $query->where('status', 'shipped')),

            // Tab that shows only delivered orders
            'delivered' => Tab::make('Delivered Orders')
                ->query(fn (Builder $query) => $query->where('status', 'delivered')),

            // Tab that shows only cancelled orders
            'cancelled' => Tab::make('Cancelled Orders')
                ->query(fn (Builder $query) => $query->where('status', 'cancelled')),
        ];
    }
}
