<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdersRelationManager extends RelationManager
{
    // Defines the relationship managed by this relation manager
    protected static string $relationship = 'orders';

    // Defines the form schema for creating and editing related records
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Currently, the form schema is empty as there are no form fields defined
            ]);
    }

    // Defines the table schema for listing related records
    public function table(Table $table): Table
    {
        return $table
            // Sets the title attribute for each record in the table
            ->recordTitleAttribute('id')
            ->columns([
                // Column for displaying the order ID
                TextColumn::make('id')
                    ->label('Order ID')
                    ->searchable(),

                // Column for displaying the grand total of the order, formatted as currency
                TextColumn::make('grand_total')
                    ->label('Total')
                    ->money('EUR', 100)
                    ->sortable(),

                // Column for displaying the status of the order with a badge and conditional formatting
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'new' => 'info',
                        'processing' => 'warning',
                        'shipped' => 'success',
                        'delivered' => 'success',
                        'canceled' => 'danger',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'new' => 'heroicon-m-sparkles',
                        'processing' => 'heroicon-m-arrow-path',
                        'shipped' => 'heroicon-m-truck',
                        'delivered' => 'heroicon-m-check-badge',
                        'canceled' => 'heroicon-m-x-circle',
                    })
                    ->sortable(),

                // Column for displaying the payment method
                TextColumn::make('payment_method')
                    ->searchable()
                    ->sortable(),

                // Column for displaying the payment status with a badge
                TextColumn::make('payment_status')
                    ->searchable()
                    ->badge()
                    ->sortable(),

                // Column for displaying the order creation date, formatted as a date-time
                TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime(),
            ])
            ->filters([
                // Currently, there are no filters defined
            ])
            ->headerActions([
                // The Create action is commented out, so it's not available
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Action for viewing the order, linking to the OrderResource view page
                Tables\Actions\Action::make("View Order")
                    ->url(fn(Order $record): string => OrderResource::getUrl('view', ['record' => $record]))
                    ->color('info')
                    ->icon('heroicon-m-eye'),

                // Action for deleting the order
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Group of bulk actions, currently only includes delete action
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
