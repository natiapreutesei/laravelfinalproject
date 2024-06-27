<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    // The column span for this widget in the dashboard layout
    protected int|string|array $columnSpan = 'full';

    // The sort order for this widget in the dashboard layout
    protected static ?int $sort = 2;

    // Defines the table schema for displaying the latest orders
    public function table(Table $table): Table
    {
        return $table
            // Query to fetch the orders, using the Eloquent query from OrderResource
            ->query(OrderResource::getEloquentQuery())
            // Default pagination to show 5 orders per page
            ->defaultPaginationPageOption(5)
            // Default sorting by 'created_at' column in descending order
            ->defaultSort('created_at', 'desc')
            // Columns to be displayed in the table
            ->columns([
                // Column for order ID
                TextColumn::make('id')
                    ->label('Order ID')
                    ->searchable(),

                // Column for customer name
                TextColumn::make('user.name')
                    ->searchable(),

                // Column for order total, formatted as currency
                TextColumn::make('grand_total')
                    ->label('Total')
                    ->money('EUR', divideBy: 100)
                    ->sortable(),

                // Column for order status with color and icon based on status value
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'new' => 'info',
                        'processing' => 'warning',
                        'shipped' => 'success',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                    })
                    ->icon(fn(string $state): string => match ($state){
                        'new' => 'heroicon-m-sparkles',
                        'processing' => 'heroicon-m-arrow-path',
                        'shipped' => 'heroicon-m-truck',
                        'delivered' => 'heroicon-m-check-badge',
                        'cancelled' => 'heroicon-m-x-circle',
                    })
                    ->sortable(),

                // Column for payment method
                TextColumn::make('payment_method')
                    ->searchable()
                    ->sortable(),

                // Column for payment status with badge
                TextColumn::make('payment_status')
                    ->searchable()
                    ->badge()
                    ->sortable(),

                // Column for order date
                TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime(),
            ])
            // Actions available for each row in the table
            ->actions([
                // Action to view order details
                Action::make('View Order')
                    ->url(fn(Order $record): string => OrderResource::getUrl('view', ['record' => $record]))
                    ->icon('heroicon-s-chevron-right')
            ]);
    }
}
